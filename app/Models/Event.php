<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['nama', 'kode'];

    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }
}
