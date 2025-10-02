<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket';
    protected $primaryKey = 'id';
    protected $fillable = ['kode', 'harga', 'event_id'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
}
}