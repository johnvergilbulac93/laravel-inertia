<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Lead extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function reminders()
    {
        return $this->hasMany(Reminder::class)->where('user_id',Auth::user()->id)->orderByDesc('id');
    }

}
