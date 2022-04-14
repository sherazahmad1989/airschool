<?php

namespace App\Models;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;
    protected $appends = ['current_date_time'];

    public function getCurrentdateTimeAttribute()
    {
        if ($this->deadline) {
            $userTimeZone = Auth::user()->timezone;
            $date = new DateTime($this->deadline, new DateTimeZone($this->timezone));
            $date->setTimezone(new DateTimeZone($this->timezone));
            return $date->format('Y-m-d H:i:sP');
        } else {
            return $this->deadline;
        }
    }
}
