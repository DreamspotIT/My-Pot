@extends('layouts/contentNavbarLayout')

@section('title', isset($goldItem) ? 'Edit Gold Item' : 'Add Gold Item')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">{{ isset($goldItem) ? 'Edit' : 'Add' }} Gold Item</h5>
    <a href="{{ route('gold-items.index') }}" class="btn btn-secondary">Back to List</a>
  </div>

  <div class="card-body">
<form action="{{ isset($goldItem) ? route('gold-items.update', $goldItem->id) : route('gold-items.store') }}" 
      method="POST" 
      enctype="multipart/form-data">
      @csrf
      @if(isset($goldItem)) @method('PUT') @endif

      {{-- Category --}}
      <div class="mb-3">
        <label class="form-label">Category <span class="text-danger">*</span></label>
        <select name="category_id" class="form-select" required>
          <option value="">Select Category</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}"
              {{ old('category_id', $goldItem->category_id ?? '') == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Subcategory --}}
      <div class="mb-3">
        <label class="form-label">Subcategory <span class="text-danger">*</span></label>
        <select name="subcategory_id" class="form-select" required>
          <option value="">Select Subcategory</option>
          @foreach($subcategories as $subcategory)
            <option value="{{ $subcategory->id }}"
              {{ old('subcategory_id', $goldItem->subcategory_id ?? '') == $subcategory->id ? 'selected' : '' }}>
              {{ $subcategory->name }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Name --}}
      <div class="mb-3">
        <label class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $goldItem->name ?? '') }}" required>
      </div>

      {{-- Price --}}
      <div class="mb-3">
        <label class="form-label">Price (₹) <span class="text-danger">*</span></label>
        <input type="number" name="price" class="form-control" value="{{ old('price', $goldItem->price ?? '') }}" required>
      </div>
{{-- Discount --}}
<div class="mb-3">
  <label class="form-label">Discount (%)</label>
  <input type="number" name="discount" step="0.01" max="100" class="form-control"
         value="{{ old('discount', $goldItem->discount ?? '') }}">
</div>

      {{-- Weight --}}
      <div class="mb-3">
        <label class="form-label">Weight (g) <span class="text-danger">*</span></label>
        <input type="number" name="weight" step="0.01" class="form-control" value="{{ old('weight', $goldItem->weight ?? '') }}" required>
      </div>

      {{-- Purity --}}
      <div class="mb-3">
        <label class="form-label">Purity <span class="text-danger">*</span></label>
        <select name="purity" class="form-select" required>
          <option value="">Select Purity</option>
          <option value="24K" {{ old('purity', $goldItem->purity ?? '') == '24K' ? 'selected' : '' }}>24K</option>
          <option value="22K" {{ old('purity', $goldItem->purity ?? '') == '22K' ? 'selected' : '' }}>22K</option>
          <option value="18K" {{ old('purity', $goldItem->purity ?? '') == '18K' ? 'selected' : '' }}>18K</option>
        </select>
      </div>

      {{-- Description --}}
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $goldItem->description ?? '') }}</textarea>
      </div>
      {{-- Image --}}
<div class="mb-3">
  <label class="form-label">Image</label>
  <input type="file" name="image" class="form-control">
  @if (isset($goldItem) && $goldItem->image)
    <div class="mt-2">
      <img src="{{ asset('storage/' . $goldItem->image) }}" width="100" class="rounded" alt="Gold Item Image">
    </div>
  @endif
</div>


      {{-- Submit Button --}}
      <div class="text-start">
        <button type="submit" class="btn btn-success">
          {{ isset($goldItem) ? 'Update' : 'Add' }}
        </button>
        <a href="{{ route('gold-items.index') }}" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
