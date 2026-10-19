<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'image',
        'price',
        'old_price',
        'short_description',
        'description',
        'badge',
        'featured',
        'stock',
        'is_active',
    ];

    /**
     * Los precios son pesos colombianos, que no manejan centavos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'old_price' => 'integer',
            'featured' => 'boolean',
            'stock' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function specs(): HasMany
    {
        return $this->hasMany(ProductSpec::class)->orderBy('sort_order');
    }

    /**
     * Reemplaza todas las especificaciones del producto, respetando el orden recibido.
     *
     * @param  list<string>  $values
     */
    public function replaceSpecs(array $values): void
    {
        $this->specs()->delete();

        foreach ($values as $index => $value) {
            $this->specs()->create([
                'name' => 'Especificación',
                'value' => $value,
                'sort_order' => $index + 1,
            ]);
        }
    }

    /**
     * Productos visibles en la tienda.
     */
    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * Productos de la sección "Lo más pedido" de la portada.
     */
    #[Scope]
    protected function featured(Builder $query): void
    {
        $query->where('featured', true);
    }

    /**
     * Productos rebajados: los que tienen un precio anterior.
     */
    #[Scope]
    protected function onSale(Builder $query): void
    {
        $query->whereNotNull('old_price');
    }
}
