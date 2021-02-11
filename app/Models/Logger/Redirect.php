<?php

namespace App\Models\Logger;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    use HasFactory;

    protected $fillable = [
        'url'
    ];

    public function logger()
    {
        return $this->belongsTo('App\Models\Logger\Logger');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Logger\Country');
    }
}
