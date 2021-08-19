<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDrink extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'drink_id',
        'consumed_at'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function drinks()
    {
        return $this->hasMany('App\Drink');
    }
}
