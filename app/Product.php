<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

/**
 * Class Product
 * @package App
 * @property ProductImage image
 * @property Collection additionalImages
 * @property ProductCategory category
 * @property ProductType type
 */
class Product extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'category_id',
        'type_id',
        'image_id',
    ];

    protected $appends = [
        'imageUrl'
    ];

    public function image(): HasOne
    {
        return $this->hasOne(ProductImage::class, 'id', 'image_id');
    }

    public function scopeSorted(Builder $query): Collection
    {
        return $this->scopeSortByPreference($query)->get();
    }

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('visible', true);
    }

    public function scopeSortByPreference(Builder $query): Builder
    {
        return $query->orderBy('preference', 'desc');
    }

    public function additionalImages(): HasManyThrough
    {
        return $this->hasManyThrough(
            ProductImage::class,
            AdditionalProductImage::class,
            'product_id',
            'id',
            'id',
            'image_id'
        );
    }

    public function getImageUrlAttribute(): string
    {
        $wrapped = optional($this->image);

        return $wrapped->url ?? asset('not-found.png');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'type_id', 'id');
    }

    public function generateSlug(): void
    {
        $this->slug = Str::slug($this->name) . '-' . hash('crc32', 'category' . $this->id);
        $this->save();
    }

    public function getRouteKeyName(): string
    {
        return "slug";
    }
}
