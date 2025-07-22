@extends('layouts/contentNavbarLayout')

@section('title', isset($gold_offer) ? 'Edit Offer' : 'Add Offer')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">{{ isset($gold_offer) ? 'Edit' : 'Add' }} Item Offer</h5>
    <a href="{{ route('gold-offers.index') }}" class="btn btn-secondary">Back to List</a>
  </div>


    <div class="card-body">
        <form method="POST" action="{{ isset($gold_offer) ? route('gold-offers.update', $gold_offer->id) : route('gold-offers.store') }}">
            @csrf
            @if(isset($gold_offer)) @method('PUT') @endif

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title', $gold_offer->title ?? '') }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Discount (%)</label>
                <input type="number" name="discount" step="0.01" value="{{ old('discount', $gold_offer->discount ?? '') }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Start Date</label>
                <input type="date" name="start_date" value="{{ old('start_date', $gold_offer->start_date ?? '') }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>End Date</label>
                <input type="date" name="end_date" value="{{ old('end_date', $gold_offer->end_date ?? '') }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ old('description', $gold_offer->description ?? '') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">{{ isset($gold_offer) ? 'Update' : 'Add' }}</button>
            <a href="{{ route('gold-offers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
