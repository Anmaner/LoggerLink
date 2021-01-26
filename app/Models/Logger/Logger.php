<?php

namespace App\Models\Logger;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $token
 * @property string $redirect
 * @property string $code
 * @property int $status
 * @property User $user
 */
class Logger extends Model
{
    use HasFactory;

    public const STATUS_ENABLE = 1;
    public const STATUS_DISABLE = 0;

    protected $fillable = [
        'token',
        'redirect',
        'code',
        'status'
    ];

    public function getRouteKeyName()
    {
        return 'token';
    }

    public static function generate(User $user, $token): self
    {
        $logger = self::make([
            'token' => $token,
            'status' => self::STATUS_ENABLE
        ]);

        $logger->user()->associate($user);
        $logger->saveOrFail();

        return $logger;
    }

    public static function notExists($token): bool
    {
        return (bool) !self::where('token', $token)->first();
    }

    public static function getStatusList(): array
    {
        return [
            self::STATUS_ENABLE,
            self::STATUS_DISABLE
        ];
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
