<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use Notifiable;

    protected $fillable = ['name', 'slug', 'parent_id', 'user_id'];

    /**
     * Define a self-referential relationship for child categories.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children');
    }

    /**
     * Define a self-referential relationship for the parent category.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Define a relationship with the Post model for categorized posts.
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'categorizable');
    }

    /**
     * Define a relationship with the Page model for categorized pages.
     */
    public function pages()
    {
        return $this->morphedByMany(Page::class, 'categorizable');
    }

    /**
     * Define a relationship with the User model.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
