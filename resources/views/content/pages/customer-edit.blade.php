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

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">First Name <span class="text-danger">*</span></label>
          <input type="text" name="firstname" value="{{ old('firstname', $customer->firstname) }}" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Middle Name</label>
          <input type="text" name="middlename" value="{{ old('middlename', $customer->middlename) }}" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Last Name <span class="text-danger">*</span></label>
          <input type="text" name="lastname" value="{{ old('lastname', $customer->lastname) }}" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Email <span class="text-danger">*</span></label>
          <input type="email" name="email" value="{{ old('email', $customer->email) }}" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Phone <span class="text-danger">*</span></label>
          <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Gender <span class="text-danger">*</span></label>
          <select name="gender" class="form-control" required>
            <option value="">Select Gender</option>
            <option value="male" {{ old('gender', $customer->gender) == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $customer->gender) == 'female' ? 'selected' : '' }}>Female</option>
            <option value="other" {{ old('gender', $customer->gender) == 'other' ? 'selected' : '' }}>Other</option>
          </select>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Role <span class="text-danger">*</span></label>
          <select name="role" class="form-control" required>
            <option value="">Select Role</option>
            <option value="customer" {{ old('role', $customer->role) == 'customer' ? 'selected' : '' }}>Customer</option>
            <option value="user" {{ old('role', $customer->role) == 'user' ? 'selected' : '' }}>User</option>
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
