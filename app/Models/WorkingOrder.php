<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingOrder extends Model
{
    use HasFactory;
    protected $primaryKey = 'no_working_order'; // Set the primary key
    // Define other properties, relationships, etc.
    public $incrementing = false; // Since the primary key is not auto-incrementing
    protected $keyType = 'string'; // Define the key type
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
