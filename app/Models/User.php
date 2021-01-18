<?php

namespace App\Models;

use App\Models\User\EmailChange;
use App\Models\User\Notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $verify_token
 * @property Carbon $email_verified_at
 * @property EmailChange $emailChange
 * @property Notification $notification
 */

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'verify_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function emailChange()
    {
        return $this->hasOne('App\Models\User\EmailChange');
    }

    public function notification()
    {
        return $this->hasOne('App\Models\User\Notification');
    }

    public static function register($name, $email, $password): self
    {
        return self::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => null,
            'verify_token' => Str::random(40),
        ]);
    }

    public function changeEmail($email): self
    {
        $this->email = $email;
        $this->saveOrFail();

        return $this;
    }

    public function verify(Carbon $time): self
    {
        if($this->isVerified()) {
            throw new \DomainException('User is already verified.');
        }


        $this->email_verified_at = $time;
        $this->verify_token = null;
        $this->saveOrFail();

        return $this;
    }

    public function isVerified(): bool
    {
        return (bool) $this->email_verified_at;
    }

    public function changePassword($newPassword): self
    {
        $this->password = Hash::make($newPassword);
        $this->saveOrFail();

        return $this;
    }
}
