<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\Todolist;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [ ];

    protected $fillable = ['name', 'created_at', 'updated_at', 'todolist_id'];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function todolist(): BelongsTo
    {
        return $this->belongsTo(Todolist::class);
    }
}
