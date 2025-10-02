<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';
    protected $primaryKey = 'id';
    protected $fillable = ['kode', 'nama'];

    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }
}