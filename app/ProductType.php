<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class ProductType
 * @package App
 * @property ProductCategory category
 * @property Collection products
 */
class ProductType extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'category_id'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'type_id', 'id');
    }

    public function generateSlug(): void
    {
        $this->slug = Str::slug($this->name) . '-' . hash('crc32', 'type' . $this->id);
        $this->save();
    }
}
