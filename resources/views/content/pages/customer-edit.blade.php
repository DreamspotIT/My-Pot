@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Customer')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Edit Customer</h5>
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

    <form action="{{ route('customer.update', $customer->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Name <span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <input type="text" name="name" value="{{ $customer->name }}" class="form-control" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <input type="email" name="email" value="{{ $customer->email }}" class="form-control" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="col-sm-2 col-form-label">Phone <span class="text-danger">*</span></label>
        <div class="col-sm-10">
          <input type="text" name="phone" value="{{ $customer->phone }}" class="form-control" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="col-sm-2 col-form-label">Gender <span class="text-danger"> *</span></label>
        <div class="col-sm-10">
          <select name="gender" class="form-control" required>
            <option value="Male" {{ $customer->gender == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ $customer->gender == 'Female' ? 'selected' : '' }}>Female</option>
            <option value="Other" {{ $customer->gender == 'Other' ? 'selected' : '' }}>Other</option>
          </select>
        </div>
      </div>
      <div class="mb-3">
  <label class="col-sm-2 col-form-label">Role <span class="text-danger">*</span></label>
  <div class="col-sm-10">
    <select name="role" class="form-control" required>
      <option value="">Select Role</option>
      <option value="customer" {{ $customer->role == 'customer' ? 'selected' : '' }}>Customer</option>
      <option value="user" {{ $customer->role == 'user' ? 'selected' : '' }}>User</option>
    </select>
  </div>
</div>


      <div class="text-start">
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('customers.list') }}" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
