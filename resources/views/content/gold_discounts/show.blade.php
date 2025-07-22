@extends('layouts/contentNavbarLayout')

@section('title', 'View Discount')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0"> Discount Details</h5>
    <a href="{{ route('discounts.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
  </div>

  <div class="card-body">
    <div class="row mb-3">
      <div class="col-md-4"><strong>Name</strong></div>
      <div class="col-md-8">:   {{ $discount->name }}</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Percentage</strong></div>
      <div class="col-md-8">:   {{ $discount->percentage }}%</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Code</strong></div>
      <div class="col-md-8">:   {{ $discount->code ?? '-' }}</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Minimum Purchase</strong></div>
      <div class="col-md-8">:   ₹{{ number_format($discount->min_purchase, 2) ?? '-' }}</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Start Date</strong></div>
      <div class="col-md-8">:   {{ $discount->start_date ?? '-' }}</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>End Date</strong></div>
      <div class="col-md-8">:  {{ $discount->end_date ?? '-' }}</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Description</strong></div>
      <div class="col-md-8">:  {{ $discount->description ?? '-' }}</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Status:</strong></div>
      <div class="col-md-8">
        @if($discount->is_active)
          <span class="badge bg-success">Active</span>
        @else
          <span class="badge bg-secondary">Inactive</span>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
