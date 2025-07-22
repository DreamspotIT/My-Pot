@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Discount')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Edit Gold Discount</h5>
    <a href="{{ route('discounts.index') }}" class="btn btn-secondary">Back to List</a>
  </div>

  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('discounts.update', $discount->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $discount->name) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Percentage (%) <span class="text-danger">*</span></label>
        <input type="number" step="0.01" name="percentage" class="form-control" value="{{ old('percentage', $discount->percentage) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Discount Code</label>
        <input type="text" name="code" class="form-control" value="{{ old('code', $discount->code) }}">
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Minimum Purchase (₹)</label>
        <input type="number" step="0.01" name="min_purchase" class="form-control" value="{{ old('min_purchase', $discount->min_purchase) }}">
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Start Date</label>
        <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $discount->start_date) }}">
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">End Date</label>
        <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $discount->end_date) }}">
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $discount->description) }}</textarea>
      </div>

<div class="form-check form-switch mb-3">
  <input class="form-check-input" type="checkbox" disabled checked>
  <label class="form-check-label fw-bold">Status will be set automatically</label>
</div>


      <button type="submit" class="btn btn-success">Update Discount</button>
      <a href="{{ route('discounts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>
@endsection
