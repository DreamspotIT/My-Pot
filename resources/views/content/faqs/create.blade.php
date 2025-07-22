@extends('layouts/contentNavbarLayout')

@section('title', 'Add FAQ')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Add FAQ</h5>
    <a href="{{ route('faqs.index') }}" class="btn btn-sm btn-secondary">Back to List</a>
  </div>

  <div class="card-body">
    <form action="{{ route('faqs.store') }}" method="POST">
      @csrf

      {{-- Question --}}
      <div class="mb-3">
        <label class="form-label">Question <span class="text-danger">*</span></label>
        <input
          type="text"
          name="question"
          class="form-control @error('question') is-invalid @enderror"
          value="{{ old('question') }}"
          required
        >
        @error('question')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Answer --}}
      <div class="mb-3">
        <label class="form-label">Answer <span class="text-danger">*</span></label>
        <textarea
          name="answer"
          rows="5"
          class="form-control @error('answer') is-invalid @enderror"
          required
        >{{ old('answer') }}</textarea>
        @error('answer')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

{{-- Status --}}
<div class="mb-3">
  <label class="form-label">Status</label>
  <select name="status" class="form-select">
    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
  </select>
</div>

      {{-- Submit Buttons --}}
      <button type="submit" class="btn btn-success">Save</button>
      <a href="{{ route('faqs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>
@endsection
