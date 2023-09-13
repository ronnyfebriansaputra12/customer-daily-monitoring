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

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
