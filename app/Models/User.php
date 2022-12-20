<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'avatar',
        'role',
        'email',
        'password',
        'about',
        'whatsapp',
        'last_seen',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = ['deleted_at', 'last_seen', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function avatar()
    {
        if ($this->avatar == null) {
            return url('storage/avatar/default.jpg');
        } else {
            if (\Storage::exists($this->avatar)) {
                return url('storage/' . $this->avatar);
            } else {
                return url('storage/avatar/default.jpg');
            }
        }
    }

    public function last_activity()
    {
        if (Cache::has('user-is-online-' . $this->id)) {
            return 'online';
        } else {
            return $this->last_seen->diffForHumans();
        }
    }

    public function star()
    {
        if ($this->role == 'admin') {
            return '<div class="user-avatar-badge"><div class="user-avatar-badge-border"><div class="hexagon-22-24"></div></div><div class="user-avatar-badge-content"><div class="hexagon-dark-16-18"></div></div><p class="user-avatar-badge-text">★</p></div>';
        } else {
            return;
        }
    }

    public function IsVerify($styleing = '')
    {
        if ($this->role == 'admin') {
            return '<i class="text-info bi bi-patch-check" style="' . $styleing . '" ></i>';
        } else {
            return '';
        }
    }
}
