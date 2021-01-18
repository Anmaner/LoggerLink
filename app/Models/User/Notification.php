<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property bool $offers
 * @property bool $news
 * @property bool $browser
 * @property User $user
 */
class Notification extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'offers',
        'news',
        'browser'
    ];

    protected $casts = [
        'offers' => 'bool',
        'news' => 'bool',
        'browser' => 'bool'
    ];

    public function user(): object
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function createDefault(User $user): self
    {
        $notification = self::make([
            'offers' => 0,
            'news' => 0,
            'browser' => 0
        ]);

        $notification->user()->associate($user);
        $notification->save();

        return $notification;
    }
}
