<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Repository extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
