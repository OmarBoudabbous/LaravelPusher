<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Panne extends Model
{
    /** @use HasFactory<\Database\Factories\PanneFactory> */
    use HasFactory; 

    protected $fillable = [
        'user_id',
        'voie',
        'type',
        'status',
        'comment'
    ];


    public function user() : BelongsTo {
        
        return $this->belongsTo(User::class);
    }

}
