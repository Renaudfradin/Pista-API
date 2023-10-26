<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [ ];

    protected $fillable = ['name', 'complete', 'created_at', 'updated_at', 'published_at', 'user_id', 'todolist_id'];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class);
    }
}