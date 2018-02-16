<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Task extends Model
{
          use Notifiable;
 protected $table = 'tasks';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'reference_number','dia_id','assign_to','phone_number','contact_person', 'clients_id','title','attach_file','details','due_date','status','kilometers','number_of_images','message','completion_date','modification','task_startdate','task_price','asegurado','tramitador'
    ];
}

 