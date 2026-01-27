<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getStatusAttribute($value)
    {
        if ($value == 'active') {
            return '<span class="badge badge-success">' . ucwords($value) . '</span>';
        } else {
            return '<span class="badge badge-danger">' . ucwords($value) . '</span>';
        }
    }
    public function getActionAttribute()
    {
        $editUrl   = route('users.edit', $this->id);
        $deleteUrl = route('users.destroy', $this->id);

        $button  = '<a role="button" class="btn btn-success btn-sm mx-2"
        data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasRight"
        onclick="editHandler(\'' . $editUrl . '\')">
        <i class="mdi mdi-square-edit-outline"></i>
    </a>';

        $button .= '<a role="button" class="btn btn-danger btn-sm"
        onclick="deleteHandler(\'' . $deleteUrl . '\')">
        <i class="mdi mdi-delete"></i>
    </a>';

        return $button;
    }


    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('storage/image/' . $value);
        }
        return $value;
    }
}
