@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Category')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Edit Category</h5>
    <a href="{{ route('category.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
  </div>

  <div class="card-body">
    <form method="POST" action="{{ route('category.update', $category->id) }}">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label for="rate_per_gram" class="form-label">Rate per Gram</label>
        <input type="number" step="0.01" class="form-control" id="rate_per_gram" name="rate_per_gram" value="{{ old('rate_per_gram', $category->rate_per_gram) }}">
        @error('rate_per_gram') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label for="rate_date" class="form-label">Rate Date</label>
        <input type="date" class="form-control" id="rate_date" name="rate_date" value="{{ old('rate_date', $category->rate_date) }}">
        @error('rate_date') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="text-start">
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('category.index') }}" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
