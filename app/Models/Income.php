<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use HasFactory;
    use softDeletes;
    protected $fillable = [
        'income',
        'currency',
        'month',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
