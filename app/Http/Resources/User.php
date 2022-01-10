<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordInterface;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends JsonResource implements CanResetPasswordInterface
{

    use Notifiable;
    use CanResetPassword;

    protected $token;

    public function __construct($resource, $token = null)
    {
        parent::__construct($resource);
        $this->token = $token;
    }


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'experience' => $this->experience,
            'progress' => $this->progress,
            'rank' => $this->rank,
            'level' => $this->level,
            'role' => $this->role,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'token' => $this->when($this->token, $this->token),
        ];
    }


}
