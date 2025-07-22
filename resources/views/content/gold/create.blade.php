@extends('layouts/contentNavbarLayout')

@section('title', 'Add Item')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Add Gold Item</h5>
    <a href="{{ route('gold-items.index') }}" class="btn btn-sm btn-secondary">Back to List</a>
  </div>

  <div class="card-body">

    {{-- Auto-submit Category Form --}}
    <form method="GET" action="{{ route('gold-items.create') }}" class="mb-4">
      <div class="row">
        <div class="col-md-6">
          <label class="form-label">Category</label>
          <select name="category_id" class="form-select" onchange="this.form.submit()">
            <option value="">Select Category</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
    </form>

    {{-- Gold Item Form --}}
    <form action="{{ route('gold-items.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="category_id" value="{{ request('category_id') }}">

      {{-- First Section --}}
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Subcategory</label>
          <select name="subcategory_id" class="form-select" required>
            <option value="">Select Subcategory</option>
            @php
              $subcategories = [];
              if (request('category_id')) {
                $subcategories = \App\Models\Subcategory::where('category_id', request('category_id'))->get();
              }
            @endphp
            @foreach ($subcategories as $subcategory)
              <option value="{{ $subcategory->id }}" {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                {{ $subcategory->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
      </div>

      <hr>

      {{-- Second Section --}}
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Price</label>
          <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Weight</label>
          <input type="number" step="0.01" name="weight" class="form-control" value="{{ old('weight') }}" required>
        </div>
      </div>

      <hr>

      {{-- Third Section --}}
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Purity</label>
          <select name="purity" class="form-select" required>
            <option value="">Select Purity</option>
            @foreach (['24K', '22K', '18K'] as $karat)
              <option value="{{ $karat }}" {{ old('purity') == $karat ? 'selected' : '' }}>{{ $karat }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Discount (%)</label>
          <input type="number" step="0.01" name="discount" class="form-control" value="{{ old('discount') }}">
        </div>
      </div>

      <hr>

      {{-- Fourth Section --}}
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="2">{{ old('description') }}</textarea>
      </div>

<div class="mb-3">
  <label class="form-label">Image</label>
  <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
  @error('image')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>


      {{-- Submit Buttons --}}
      <button type="submit" class="btn btn-success">Add Item</button>
      <a href="{{ route('gold-items.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

  </div>
</div>
@endsection
