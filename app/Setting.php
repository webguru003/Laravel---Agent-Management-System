<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Setting extends Model
{
          use Notifiable;
 protected $table = 'settings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stext','ftext','hcolor','fcolor','ambb','icolor','kiometers_price','numberofimages_price','vat','fixed_kilometers'
    ];
}
