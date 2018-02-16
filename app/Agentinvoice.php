<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Agentinvoice extends Model
{
          use Notifiable;
 protected $table = 'agentinvoices';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'agent_id','	invoice_number','month', 'year','total_amount'
    ];
}
