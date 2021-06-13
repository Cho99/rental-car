<?php

namespace App\Models;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    const READ = 1,
        UNREAD = 0;

    protected $guarded = [''];
        
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function getStatusNameAttribute()
    {
        switch ($this->attributes['status']) {
            case Report::UNREAD:
                return __('report.unread');
                break;
            default:
                return __('report.read');
                break;
        }
    }

    public function getStatusClassAttribute()
    {
        switch ($this->attributes['status']) {
            case Report::UNREAD:
                return 'danger';
                break;
            default:
                return 'primary';
                break;
        }
    }
}
