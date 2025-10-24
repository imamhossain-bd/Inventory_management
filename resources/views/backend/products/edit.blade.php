@extends('backend.layouts.admin')

@section('title', 'Edit Product')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Product</h2>

    <form action="{{ route('backend.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Product Basic Info --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Name --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Product Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200 focus:border-blue-400">
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Slug --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Slug <span class="text-red-500">*</span></label>
                <input type="text" name="slug" value="{{ old('slug', $product->slug) }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200 focus:border-blue-400">
                @error('slug') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- SKU --}}
            <div class="space-y-2">
                <label class="block text-gray-700 font-medium">SKU <span class="text-red-500">*</span></label>
                <div class="flex">
                    <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" placeholder="Enter or generate SKU"  class="flex-1 border border-gray-300 rounded-l-lg px-4 py-2.5
                    text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <button type="button" id="generate-sku" class="bg-blue-600 text-white px-5 rounded-r-lg text-sm font-medium hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 transition">
                        Generate
                    </button>
                </div>
                @error('sku') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Barcode --}}
           <div>
                <label class="block text-gray-700 font-medium mb-2">Barcode <span class="text-red-500">*</span></label>
                <div class="flex">
                    <input type="text" id="barcode" name="barcode" value="{{ old('barcode', $product->barcode) }}" placeholder="Enter or generate Barcode" class="flex-1 border border-gray-300 rounded-l-lg px-4 py-2.5 text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <button type="button" id="generate-barcode" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-r-lg font-medium transition" > Generate </button>
                </div>
                @error('barcode') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Stock Management --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Stock Quantity <span class="text-red-500">*</span></label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                    class="w-full border border-gray-300 rounded-lg p-2">
                @error('stock') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Stock Alert</label>
                <input type="number" name="stock_alert" value="{{ old('stock_alert', $product->stock_alert) }}"
                    class="w-full border border-gray-300 rounded-lg p-2">
                @error('stock_alert') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Dropdown Fields --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Warranty --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Warranty</label>
                <select name="warranty_id" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="">Select Warranty</option>
                    @foreach($warranties as $warranty)
                        <option value="{{ $warranty->id }}" {{ old('warranty_id', $product->warranty_id) == $warranty->id ? 'selected' : '' }}>
                            {{ $warranty->name }}
                        </option>
                    @endforeach
                </select>
                @error('warranty_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Category --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Category <span class="text-red-500">*</span></label>
                <select name="category_id" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->cat_name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Sub Category --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Sub Category</label>
                <select name="sub_category_id" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="">Select Sub Category</option>
                    @foreach($sub_categories as $sub_category)
                        <option value="{{ $sub_category->id }}" {{ old('sub_category_id', $product->sub_category_id) == $sub_category->id ? 'selected' : '' }}>
                            {{ $sub_category->name }}
                        </option>
                    @endforeach
                </select>
                @error('sub_category_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Brand & Unit --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Brand</label>
                <select name="brand_id" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="">Select Brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
                @error('brand_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Unit <span class="text-red-500">*</span></label>
                <select name="unit_id" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="">Select Unit</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}" {{ old('unit_id', $product->unit_id) == $unit->id ? 'selected' : '' }}>
                            {{ $unit->short_name }}
                        </option>
                    @endforeach
                </select>
                @error('unit_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Status <span class="text-red-500">*</span></label>
                <select name="status" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Variants --}}
        <div>
            <label class="block text-gray-700 font-medium mb-2">Variants <span class="text-red-500">*</span></label>
            <select name="variants_id" class="w-full border border-gray-300 rounded-lg p-2">
                <option value="">Select Variant</option>
                @foreach($variants as $variant)
                    <option value="{{ $variant->id }}" {{ old('variants_id', $product->variants_id) == $variant->id ? 'selected' : '' }}>
                        {{ implode(', ', $variant->value ?? []) }}
                    </option>
                @endforeach
            </select>
            @error('variants_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Description --}}
        <div>
            <label class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea name="description" rows="4"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200 focus:border-blue-400">{{ old('description', $product->description) }}</textarea>
            @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Pricing Section --}}
        <div class="border-t-2 border-[#b1b1b1] pt-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Product Pricing</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Purchase Price ($) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}" class="w-full border border-gray-300 rounded-lg p-2">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Selling Price ($) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="selling_price" id="selling_price" value="{{ old('selling_price', $product->selling_price) }}" class="w-full border border-gray-300 rounded-lg p-2">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Discount Price ($)</label>
                    <input type="number" step="0.01" name="discount_price" id="discount_price" value="{{ old('discount_price', $product->discount_price) }}" class="w-full border border-gray-300 rounded-lg p-2">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Tax Type</label>
                    <select name="tax_type" id="tax_type" class="w-full border border-gray-300 rounded-lg p-2">
                        <option value="">Select</option>
                        <option value="inclusive" {{ old('tax_type', $product->tax_type) == 'inclusive' ? 'selected' : '' }}>Inclusive</option>
                        <option value="exclusive" {{ old('tax_type', $product->tax_type) == 'exclusive' ? 'selected' : '' }}>Exclusive</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Tax Amount (%)</label>
                    <input type="number" step="0.01" name="tax_amount" id="tax_amount" value="{{ old('tax_amount', $product->tax_amount) }}" class="w-full border border-gray-300 rounded-lg p-2">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Total Amount</label>
                    <input type="number" step="0.01" name="total_amount" id="total_amount" value="{{ old('total_amount', $product->total_amount) }}" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-100 text-gray-700" readonly>
                </div>
            </div>
        </div>

        {{-- Images Section --}}
        <div class="border-t-2 border-[#b1b1b1] pt-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Images</h3>
            <div id="image-upload-section" class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                <div class="flex flex-wrap items-center gap-4" id="image-preview-container">
                    {{-- Show existing images --}}
                    @if($product->images)
                        @foreach($product->images as $img)
                            <div class="relative w-28 h-28 rounded-lg overflow-hidden border border-gray-200 bg-white shadow-sm">
                                <img src="{{ asset('storage/'.$img->path) }}" class="w-full h-full object-cover" alt="Product Image">
                                <button type="button" class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold hover:bg-red-700 remove-image">×</button>
                            </div>
                        @endforeach
                    @endif
                    <label for="product_images" class="flex flex-col items-center justify-center w-28 h-28 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-white hover:bg-gray-100 transition">
                        <span class="text-gray-400 text-sm flex flex-col items-center">
                            <i class="fas fa-plus text-gray-400 text-xl mb-1"></i>
                            Add Images
                        </span>
                        <input type="file" id="product_images" name="images[]" multiple accept="image/*" class="hidden">
                    </label>
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg">Update Product</button>
        </div>
    </form>
</div>

<script>
    // SKU & Barcode same as create
    document.getElementById('generate-sku').addEventListener('click', function() {
        const randomPart = Math.random().toString(36).substring(2, 7).toUpperCase();
        const sku = `SKU-${randomPart}`;
        document.getElementById('sku').value = sku;
    });

    document.getElementById('generate-barcode').addEventListener('click', function () {
        const randomBarcode = 'BC' + Math.floor(100000000000 + Math.random() * 900000000000);
        document.getElementById('barcode').value = randomBarcode;
    });

    // Image Preview same as create
    const imageInput = document.getElementById('product_images');
    const imagePreviewContainer = document.getElementById('image-preview-container');

    imageInput.addEventListener('change', function(event) {
        const files = Array.from(event.target.files);
        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageBox = document.createElement('div');
                imageBox.classList.add('relative', 'w-28', 'h-28', 'rounded-lg', 'overflow-hidden', 'border', 'border-gray-200', 'bg-white', 'shadow-sm');
                imageBox.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover" alt="Preview">
                    <button type="button" class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold hover:bg-red-700 remove-image">×</button>
                `;
                const addBox = imagePreviewContainer.querySelector('label');
                imagePreviewContainer.insertBefore(imageBox, addBox);
                imageBox.querySelector('.remove-image').addEventListener('click', function() {
                    imageBox.remove();
                });
            };
            reader.readAsDataURL(file);
        });
        event.target.value = '';
    });

    // Selling Price Calculation same as create
    document.addEventListener('DOMContentLoaded', function() {
        const sellingPrice = document.getElementById('selling_price');
        const discountPrice = document.getElementById('discount_price');
        const taxType = document.getElementById('tax_type');
        const taxAmount = document.getElementById('tax_amount');
        const totalAmount = document.getElementById('total_amount');

        function calculateTotal() {
            let sell = parseFloat(sellingPrice.value) || 0;
            let discount = parseFloat(discountPrice.value) || 0;
            let tax = parseFloat(taxAmount.value) || 0;
            let type = taxType.value;
            let priceAfterDiscount = sell - discount;
            let total = 0;

            if (type === 'exclusive') {
                total = priceAfterDiscount + (priceAfterDiscount * tax / 100);
            } else {
                total = priceAfterDiscount;
            }
            totalAmount.value = total.toFixed(2);
        }

        [sellingPrice, discountPrice, taxAmount, taxType].forEach(el => {
            el.addEventListener('input', calculateTotal);
            el.addEventListener('change', calculateTotal);
        });
        calculateTotal();
    });
</script>
@endsection
