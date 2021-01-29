<?php

namespace App\Models\Logger;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $ip
 * @property string $provider
 * @property string $country
 * @property string $city
 * @property string $os
 * @property string $browser
 * @property string $from
 * @property Logger $logger
 * @method Follow dateFrom($date)
 * @method Follow dateTo($date)
 * @method Follow unique($unique)
 */
class Follow extends Model
{
    use HasFactory;

    protected $fillable = [
      'ip',
      'provider',
      'country',
      'city',
      'os',
      'browser',
      'from'
    ];

    public function logger()
    {
        return $this->belongsTo('App\Models\Logger\Logger');
    }

    public function scopeDateFrom($query, $date)
    {
        if($date) {
            return $query->whereDate('created_at', '>=', $date->toDateString());
        }

        return $query;
    }

    public function scopeDateTo($query, $date)
    {
        if($date) {
            return $query->whereDate('created_at', '<=', $date->toDateString());
        }

        return $query;
    }

    public function scopeUnique($query, $unique)
    {
        return $query;
    }
}
