@extends('layouts/contentNavbarLayout')

@section('title', 'Add Customer')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Add Customer</h5>
    <a href="{{ route('customers.list') }}" class="btn btn-secondary">Back to List</a>
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

<form action="{{ route('customer.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email <span class="text-danger">*</span></label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Phone <span class="text-danger">*</span></label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Gender <span class="text-danger">*</span></label>
        <select name="gender" class="form-control" required>
          <option value="">Select Gender</option>
          <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
          <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
          <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Password <span class="text-danger">*</span></label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
        <input type="password" name="password_confirmation" class="form-control" required>
      </div>

<div class="mb-3">
  <label class="form-label">Role <span class="text-danger">*</span></label>
  <select name="role" class="form-control" required>
    <option value="">Select Role</option>
    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
  </select>
</div>

      <div class="text-start">
        <button type="submit" class="btn btn-success">Add</button>
        <a href="{{ route('customers.list') }}" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
