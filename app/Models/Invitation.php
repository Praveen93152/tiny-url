<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'invited_by',
        'invited_to',
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function inviter()
    {
        return $this->belongsTo(
            User::class,
            'invited_by'
        );
    }
    
}
