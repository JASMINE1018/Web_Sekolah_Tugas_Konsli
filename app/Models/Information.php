<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Information extends Model
{
    use HasFactory;

    /**
     * Explicit table name (information).
     */
    protected $table = 'information';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'summary',
        'content',
        'category',
        'status',
        'cover_image',
        'created_by',
    ];

    /**
     * Get the author of the information.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
