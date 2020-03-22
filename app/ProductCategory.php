<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class ProductCategory
 * @package App
 * @property Collection types
 */
class ProductCategory extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function types(): HasMany
    {
        return $this->hasMany(ProductType::class, 'category_id', 'id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function generateSlug(): void
    {
        $this->slug = Str::slug($this->name) . '-' . hash('crc32', 'category' . $this->id);
        $this->save();
    }
}
