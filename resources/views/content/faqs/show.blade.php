@extends('layouts/contentNavbarLayout')

@section('title', 'FAQ Details')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">FAQ Details</h5>
    <a href="{{ route('faqs.index') }}" class="btn btn-sm btn-secondary">Back</a>
  </div>
  <div class="card-body">
    <div class="mb-3"><strong>ID:</strong> {{ $faq->id }}</div>
    <div class="mb-3"><strong>Question:</strong> {{ $faq->question }}</div>
    <div class="mb-3"><strong>Answer:</strong> {{ $faq->answer }}</div>
    <div class="mb-3"><strong>Status:</strong> 
      @if($faq->status == 'active')
        <span class="badge bg-success">Active</span>
      @else
        <span class="badge bg-danger">Inactive</span>
      @endif
    </div>
  </div>
</div>
@endsection
