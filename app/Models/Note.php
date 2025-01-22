<?php

namespace App\Models;

use App\Models\User;
use App\Models\Scopes\UserNoteScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content'];

    protected static function booted()
    {
        static::addGlobalScope(new UserNoteScope);
    }    

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }    

}
