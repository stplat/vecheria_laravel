<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'product';
  protected $primaryKey = 'product_id';

  protected $fillable = [
    'name', 'slug', 'category_id', 'manufacturer', 'article', 'meta_keywords', 'meta_description', 'meta_title', 'available', 'weight',
    'price', 'dimension', 'comment', 'material', 'technic', 'description', 'video', 'image_path', 'similar_product_id',
  ];

  public function categories()
  {
    return $this->belongsToMany(Category::class, 'product_to_category',
      'product_id', 'category_id', 'product_id', 'category_id')->withTimestamps();
  }
}
