<?php

namespace App\Http\Requests;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Valida el formulario de crear y editar productos del panel de administración.
 */
class GuardarProductoRequest extends FormRequest
{
    /**
     * El acceso ya lo controla el grupo de rutas "admin" con el Gate "administrar".
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Si el slug viene vacío se genera a partir del nombre, y los checkboxes
     * sin marcar (que el navegador no envía) se convierten en false.
     */
    protected function prepareForValidation(): void
    {
        $slug = $this->string('slug')->trim()->toString();

        $this->merge([
            'slug' => Str::slug($slug !== '' ? $slug : $this->string('name')->toString()),
            'featured' => $this->boolean('featured'),
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isNewProduct = $this->route('product') === null;

        return [
            'category_id' => ['required', 'integer', Rule::exists(Category::class, 'id')],
            'brand_id' => ['required', 'integer', Rule::exists(Brand::class, 'id')],
            'name' => ['required', 'string', 'max:150'],
            'slug' => ['required', 'string', 'max:150', Rule::unique(Product::class)->ignore($this->route('product'))],
            'price' => ['required', 'integer', 'min:1'],
            'old_price' => ['nullable', 'integer', 'gt:price'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'badge' => ['nullable', 'string', 'max:50'],
            'stock' => ['required', 'integer', 'min:0'],
            'featured' => ['boolean'],
            'is_active' => ['boolean'],
            'specs' => ['nullable', 'string', 'max:3000'],
            'image' => [$isNewProduct ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'old_price.gt' => 'El precio anterior debe ser mayor que el precio actual (si no está en oferta, déjalo vacío).',
        ];
    }

    /**
     * Columnas del producto listas para guardar (la imagen y las specs se manejan aparte).
     *
     * @return array<string, mixed>
     */
    public function productAttributes(): array
    {
        return $this->safe()->except(['image', 'specs']);
    }

    /**
     * Las especificaciones escritas una por línea, sin líneas vacías.
     *
     * @return list<string>
     */
    public function specValues(): array
    {
        return Str::of($this->validated('specs') ?? '')
            ->explode("\n")
            ->map(fn (string $line): string => trim($line))
            ->filter()
            ->values()
            ->all();
    }
}
