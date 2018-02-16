<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Invoice extends Model
{
          use Notifiable;
 protected $table = 'invoices';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'task_id','invoice_number','date_created', 'total_amount',
    ];
}
