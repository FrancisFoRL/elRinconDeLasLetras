<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'isbn', 'description', 'price', 'image', 'pages', 'editorial_id', 'author_id', 'stock'];

    public function editorial()
    {
        return $this->belongsTo(Editorial::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'books_categories', 'book_id', 'category_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'books_orders', 'book_id', 'order_id');
    }


    public function getSlugAttribute()
    {
        return Str::slug($this->title);
    }
}
