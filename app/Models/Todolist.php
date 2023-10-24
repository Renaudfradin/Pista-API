<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use Laravel\Sanctum\HasApiTokens;

class Todolist extends Model
{
    use HasApiTokens, HasFactory;

    protected $guarded = [ ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
