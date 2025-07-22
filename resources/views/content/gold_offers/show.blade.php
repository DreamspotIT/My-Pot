@extends('layouts/contentNavbarLayout')

@section('title', 'View Item Offer')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Offer Details</h5>
    <a href="{{ route('gold-offers.index') }}" class="btn btn-secondary btn-sm">Back</a>
  </div>

  <div class="card-body">
    <div class="row mb-3">
      <div class="col-md-4"><strong>ID</strong></div>
      <div class="col-md-8">:   {{ $gold_offer->id }}</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Title</strong></div>
      <div class="col-md-8">:   {{ $gold_offer->title }}</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Discount</strong></div>
      <div class="col-md-8">:   {{ $gold_offer->discount }}%</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Start Date</strong></div>
      <div class="col-md-8">:   {{ $gold_offer->start_date }}</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>End Date</strong></div>
      <div class="col-md-8">:   {{ $gold_offer->end_date }}</div>
    </div>

    <div class="row mb-3">
      <div class="col-md-4"><strong>Description</strong></div>
      <div class="col-md-8">:   {{ $gold_offer->description ?? '-' }}</div>
    </div>
  </div>
</div>
@endsection
