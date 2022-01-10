<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\User as UserResource;


class UserController extends Controller
{
    //Función de autentición del sistema
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email');
        $users = User::all();
        $user = null;
        foreach ($users as $u) {
            if ($request->email === $u->email) {
                $user = $u;
            }
        }

        try {
            if (!$token = JWTAuth::fromUser($user)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        //$user = JWTAuth::user();
        return response()->json(new UserResource($user, $token))
            //return response()->json(compact('token', 'user'))
            ->withCookie(
                'token',
                $token,
                config('jwt.ttl'), // ttl => time to live
                '/', // path
                null, // domain
                config('app.env') !== 'local', // Secure
                true, // httpOnly
                false, //
                config('app.env') !== 'local' ? 'None' : 'Lax' // SameSite
            );
    }

    //Función de registro del sistema
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        $token = JWTAuth::fromUser($user);

        return response()->json(new UserResource($user, $token), 201)
            ->withCookie(
                'token',
                $token,
                config('jwt.ttl'),
                '/',
                null,
                config('app.env') !== 'local',
                true,
                false,
                config('app.env') !== 'local' ? 'None' : 'Lax'
            );
    }

    //Función de obtención del usuario autenticado del sistema
    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(new UserResource($user), 200);

    }

    //Función de cierre de sesió del sistema
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            //  Cookie::queue(Cookie::forget('token'));
            //  $cookie = Cookie::forget('token');
            //  $cookie->withSameSite('None');
            return response()->json([
                "status" => "success",
                "message" => "User successfully logged out."
            ], 200)
                ->withCookie('token', null,
                    config('jwt.ttl'),
                    '/',
                    null,
                    config('app.env') !== 'local',
                    true,
                    false,
                    config('app.env') !== 'local' ? 'None' : 'Lax'
                );
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(["message" => "No se pudo cerrar la sesión."], 500);
        }
    }

    //Funcion para la obtencion de los datos de un usuario en específico
    public function show(User $user)
    {
        $this->authorize('view', $user);
        return $user;
    }

    //Funcion para actualiación de datos del usuario
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $validatedData = $request->validate([
            'experience' => 'numeric',
            'progress' => 'numeric',
            'rank' => 'string',
            'level' => 'numeric',
        ]);

        $user->update($request->all());
        return response()->json($user, 200);
    }
    //Función para eliminación de usuario
    public function delete(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    //Función para la obtención de la lista de usuarios
    public function allUsers() {
        $this->authorize('all', User::class);
        return User::all();
    }

}
