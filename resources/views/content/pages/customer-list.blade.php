@extends('layouts/contentNavbarLayout')

@section('title', 'Customer List')

@section('content')

@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Customer List</h5>
    <a href="{{ route('customer.create') }}" class="btn btn-primary btn-sm">Add New</a>
  </div>

  <div class="table-responsive text-nowrap">
    <table class="table table-bordered table-hover">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Gender</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($customers as $customer)
        <tr>
          <td>{{ $customer->id }}</td>
          <td>{{ $customer->name }}</td>
          <td>{{ $customer->email }}</td>
          <td>{{ $customer->phone }}</td>
          <td>{{ $customer->gender }}</td>
          <td>
            <a href="{{ route('customer.show', $customer->id) }}" class="btn btn-sm btn-secondary">View</a>
            <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-sm btn-info">Edit</a>
            <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this customer?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
        @if($customers->isEmpty())
        <tr>
          <td colspan="6" class="text-center">No customers found.</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
<div class="card-footer d-flex justify-content-end">
  {{ $customers->links('pagination::bootstrap-5') }}
</div>

</div>
@endsection
