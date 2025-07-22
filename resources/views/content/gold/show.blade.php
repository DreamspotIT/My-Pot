@extends('layouts/contentNavbarLayout')

@section('title', ' Item Details')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Item Details</h5>
    <a href="{{ route('gold-items.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
  </div>

  <div class="card-body">
    <div class="row mb-3">
      <div class="col-md-4"><strong>Name</strong></div>
      <div class="col-md-8">: {{ $goldItem->name }}</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Category</strong></div>
      <div class="col-md-8">: {{ $goldItem->category->name ?? '-' }}</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Subcategory</strong></div>
      <div class="col-md-8">: {{ $goldItem->subcategory->name ?? '-' }}</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Price (₹)</strong></div>
      <div class="col-md-8">: ₹{{ number_format($goldItem->price, 2) }}</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Discount (%)</strong></div>
      <div class="col-md-8">: {{ $goldItem->discount ?? '0' }}%</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Weight (gm)</strong></div>
      <div class="col-md-8">: {{ number_format($goldItem->weight, 2) }} gm</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Purity</strong></div>
      <div class="col-md-8">: {{ $goldItem->purity ?? '-' }}</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Description</strong></div>
      <div class="col-md-8">: {{ $goldItem->description ?? '-' }}</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Image</strong></div>
      <div class="col-md-8">
        @if($goldItem->image)
          <img src="{{ asset('storage/' . $goldItem->image) }}" alt="Gold Item Image" class="img-thumbnail" style="max-height: 150px;">
        @else
          No image available
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
