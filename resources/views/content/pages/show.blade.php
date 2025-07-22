@extends('layouts/contentNavbarLayout')

@section('title', 'Customer Details')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Customer Details</h5>
    <a href="{{ route('customer.index') }}" class="btn btn-sm btn-secondary">Back</a>
  </div>
  <div class="card-body">
    <div class="mb-3"><strong>ID:</strong> {{ $customer->id }}</div>
    <div class="mb-3">
      <strong>Name:</strong> 
      {{ $customer->firstname }}
      @if(!empty($customer->middlename))
        {{ $customer->middlename }}
      @endif
      {{ $customer->lastname }}
    </div>
    <div class="mb-3"><strong>Email:</strong> {{ $customer->email }}</div>
    <div class="mb-3"><strong>Phone:</strong> {{ $customer->phone }}</div>
    <div class="mb-3"><strong>Gender:</strong> {{ $customer->gender }}</div>
    {{-- Add other fields as needed --}}
  </div>
</div>
@endsection
