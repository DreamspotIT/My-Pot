@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Subcategory')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Edit Subcategory</h5>
    <a href="{{ route('subcategory.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
  </div>

  <div class="card-body">
    <form action="{{ route('subcategory.update', $subcategory->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Category <span class="text-danger">*</span></label>
        <select name="category_id" class="form-select" required>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Subcategory Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" value="{{ $subcategory->name }}" required>
      </div>

      <button type="submit" class="btn btn-success">Update</button>
    </form>
  </div>
</div>
@endsection
