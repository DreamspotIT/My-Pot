@extends('layouts/contentNavbarLayout')

@section('title', 'Add Category')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Add Category</h5>
    <a href="{{ route('category.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
  </div>

  <div class="card-body">
    <form method="POST" action="{{ route('category.store') }}">
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label for="rate_per_gram" class="form-label">Rate Per Gram <span class="text-danger">*</span></label>
        <input type="number" step="0.01" class="form-control" id="rate_per_gram" name="rate_per_gram" value="{{ old('rate_per_gram') }}" required>
        @error('rate_per_gram') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

<div class="mb-3">
  <label for="rate_date" class="form-label">Rate Date <span class="text-danger">*</span></label>
  <input type="date" class="form-control" id="rate_date" name="rate_date" value="{{ old('rate_date', date('Y-m-d')) }}" required>
  @error('rate_date') <small class="text-danger">{{ $message }}</small> @enderror
</div>
      <div class="text-start">
        <button type="submit" class="btn btn-success">Add</button>
        <a href="{{ route('category.index') }}" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
