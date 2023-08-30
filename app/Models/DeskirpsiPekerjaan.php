<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskirpsiPekerjaan extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function pengerjaan()
    {
        return $this->belongsTo(Pengerjaan::class);
    }
}
