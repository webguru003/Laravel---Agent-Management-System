<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Client extends Model
{
          use Notifiable;
 protected $table = 'clients';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contactname','companyname'
    ];
}
