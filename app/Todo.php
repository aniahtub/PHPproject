<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Todo extends Model
{
    protected $fillable = ['name','description','reminder','priority','completed'];
    // public function setReminderAttribute($value)
    // {
    //     $this->attributes['reminder'] = strtolower($value);
    // }
}
