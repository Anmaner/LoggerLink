<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $status
 * @property string $email
 * @property string $old_token
 * @property string $new_token
 */
class EmailChange extends Model
{
    use HasFactory;

    public const OLD_REQUESTED = 'old_requested';
    public const OLD_CONFIRMED = 'old_confirmed';
    public const NEW_REQUESTED = 'new_requested';

    public $timestamps = false;

    protected $fillable = ['status', 'email', 'old_token', 'new_token'];

    public function user(): object
    {
        return $this->belongsTo('App\Models\User');
    }

    public function isOldRequested(): bool
    {
        return $this->status === self::OLD_REQUESTED;
    }

    public function isOldConfirmed(): bool
    {
        return $this->status === self::OLD_CONFIRMED;
    }

    public function isNewRequested(): bool
    {
        return $this->status === self::NEW_REQUESTED;
    }

    public static function create(User $user, $newEmail): self
    {
        $new = new self();

        $new->status = self::OLD_REQUESTED;
        $new->email = $newEmail;
        $new->old_token = Str::random(40);
        $new->user()->associate($user);

        $new->saveOrFail();

        return $new;
    }

    public function requestNew(): self
    {
        $this->guardStatusEquals(self::OLD_CONFIRMED);

        $this->status = self::NEW_REQUESTED;
        $this->new_token = Str::random(40);
        $this->saveOrFail();

        return $this;
    }

    public function confirmOld($token): self
    {
        if($this->old_token !== $token) {
            throw new \DomainException('Invalid email token given.');
        }

        $this->guardStatusEquals(self::OLD_REQUESTED);

        $this->status = self::OLD_CONFIRMED;
        $this->old_token = null;
        $this->saveOrFail();

        return $this;
    }

    public function confirmNew($token): void
    {
        if($this->new_token !== $token) {
            throw new \DomainException('Invalid email token given.');
        }

        $this->guardStatusEquals(self::NEW_REQUESTED);

        $this->delete();
    }

    protected function guardStatusEquals($status)
    {
        if($this->status !== $status) {
            throw new \DomainException('Email change could not be completed.');
        }
    }
}
