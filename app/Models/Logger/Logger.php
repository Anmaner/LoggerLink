<?php

namespace App\Models\Logger;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
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

    public const TYPE_LOGGER = 'logger';
    public const TYPE_SHORTENER = 'shortener';

    protected $fillable = [
        'token',
        'redirect',
        'code',
        'status',
        'type'
    ];

    public function getRouteKeyName()
    {
        return 'token';
    }

    public function isEnable(): bool
    {
        if($this->status === self::STATUS_ENABLE) {
            return true;
        }

        return false;
    }

    public static function generateLogger(User $user, $token): self
    {
        $logger = self::make([
            'token' => $token,
            'status' => self::STATUS_ENABLE,
            'type' => self::TYPE_LOGGER
        ]);

        $logger->user()->associate($user);
        $logger->saveOrFail();

        return $logger;
    }

    public static function generateShortener(User $user, $token): self
    {
        $logger = self::make([
            'token' => $token,
            'status' => self::STATUS_ENABLE,
            'type' => self::TYPE_LOGGER
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

    public static function getTypeList(): array
    {
        return [
            self::TYPE_LOGGER,
            self::TYPE_SHORTENER
        ];
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function follows()
    {
        return $this->hasMany('App\Models\Logger\Follow');
    }
}
