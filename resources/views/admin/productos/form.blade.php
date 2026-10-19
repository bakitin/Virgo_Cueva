{{-- Campos compartidos por crear y editar. Recibe: $product, $categories, $brands --}}
@csrf

<div class="admin-form__field">
    <label for="name">Nombre</label>
    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required maxlength="150">
    @error('name')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>

<div class="admin-form__field">
    <label for="slug">Slug (opcional)</label>
    <input type="text" id="slug" name="slug" value="{{ old('slug', $product->slug) }}" maxlength="150">
    <span class="admin-form__hint">Es la parte final de la URL: /productos/<em>slug</em>. Si lo dejas vacío se genera con el nombre.</span>
    @error('slug')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>

<div class="admin-form__field">
    <label for="category_id">Categoría</label>
    <select id="category_id" name="category_id" required>
        <option value="">Elige una categoría</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected((int) old('category_id', $product->category_id) === $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>

<div class="admin-form__field">
    <label for="brand_id">Marca</label>
    <select id="brand_id" name="brand_id" required>
        <option value="">Elige una marca</option>
        @foreach ($brands as $brand)
            <option value="{{ $brand->id }}" @selected((int) old('brand_id', $product->brand_id) === $brand->id)>{{ $brand->name }}</option>
        @endforeach
    </select>
    @error('brand_id')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>

<div class="admin-form__field">
    <label for="price">Precio (COP)</label>
    <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" required min="1" step="1">
    @error('price')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>

<div class="admin-form__field">
    <label for="old_price">Precio anterior (opcional)</label>
    <input type="number" id="old_price" name="old_price" value="{{ old('old_price', $product->old_price) }}" min="1" step="1">
    <span class="admin-form__hint">Llénalo solo si el producto está en oferta: así aparece en la página de ofertas.</span>
    @error('old_price')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>

<div class="admin-form__field">
    <label for="stock">Stock</label>
    <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" step="1">
    @error('stock')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>

<div class="admin-form__field">
    <label for="badge">Etiqueta (opcional)</label>
    <input type="text" id="badge" name="badge" value="{{ old('badge', $product->badge) }}" maxlength="50" placeholder="Ej: Nuevo, Edición limitada">
    @error('badge')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>

<div class="admin-form__field admin-form__field--full">
    <label for="short_description">Descripción corta</label>
    <input type="text" id="short_description" name="short_description" value="{{ old('short_description', $product->short_description) }}" maxlength="255">
    <span class="admin-form__hint">Se muestra en las tarjetas del catálogo.</span>
    @error('short_description')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>

<div class="admin-form__field admin-form__field--full">
    <label for="description">Descripción completa</label>
    <textarea id="description" name="description" rows="4" maxlength="5000">{{ old('description', $product->description) }}</textarea>
    @error('description')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>

<div class="admin-form__field admin-form__field--full">
    <label for="specs">Especificaciones</label>
    <textarea id="specs" name="specs" rows="5" maxlength="3000">{{ old('specs', $product->specs->pluck('value')->implode("\n")) }}</textarea>
    <span class="admin-form__hint">Una por línea. Se muestran con un ✓ en la ficha del producto.</span>
    @error('specs')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>

<div class="admin-form__field admin-form__field--full">
    <label for="image">Foto {{ $product->exists ? '(opcional: solo si quieres cambiarla)' : '' }}</label>
    @if ($product->exists)
        <img src="{{ asset($product->image) }}" alt="Foto actual de {{ $product->name }}" class="admin-form__current-image">
    @endif
    <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp" @required(! $product->exists)>
    <span class="admin-form__hint">JPG, PNG o WEBP de hasta 2 MB.</span>
    @error('image')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>

<div class="admin-form__field admin-form__field--full admin-form__checks">
    <label>
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active))>
        Visible en la tienda
    </label>
    <label>
        <input type="checkbox" name="featured" value="1" @checked(old('featured', $product->featured))>
        Destacado en la portada ("Lo más pedido")
    </label>
</div>

<div class="admin-form__actions">
    <button type="submit" class="btn btn--primary">Guardar producto</button>
    <a href="{{ route('admin.productos.index') }}" class="btn btn--ghost">Cancelar</a>
</div>
