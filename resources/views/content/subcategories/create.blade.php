@extends('layouts/contentNavbarLayout')

@section('title', 'Add Subcategory')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Add Subcategory</h5>
    <a href="{{ route('subcategory.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
  </div>

  <div class="card-body">
    <form action="{{ route('subcategory.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label class="form-label">Category <span class="text-danger">*</span></label>
        <select name="category_id" class="form-select" required>
          <option value="">-- Select Category --</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Subcategory Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
      </div>

      <button type="submit" class="btn btn-success">Add</button>
          <a href="{{ route('subcategory.index') }}" class="btn btn-secondary">
      Cancel
    </a>

    </form>
  </div>
</div>
@endsection
