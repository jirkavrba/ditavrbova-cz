<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $guarded = [];

    protected $appends = [ 'url' ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function getUrlAttribute(): string
    {
        return Storage::url($this->path);
    }

    public function additionalImages(): HasMany
    {
        return $this->hasMany(AdditionalProductImage::class, 'image_id', 'id');
    }

    public static function boot(): void
    {
        parent::boot();
        static::deleting(function(ProductImage $image) {
            $image->additionalImages()->delete();
        });
    }
}
