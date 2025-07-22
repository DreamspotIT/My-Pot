@extends('layouts/contentNavbarLayout')

@section('title', 'Subcategory List')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Subcategory List</h5>
    <a href="{{ route('subcategory.create') }}" class="btn btn-sm btn-primary">Add Subcategory</a>
  </div>

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show m-3" id="success-alert" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Subcategory</th>
          <th>Category</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($subcategories as $subcategory)
          <tr>
            <td>{{ $subcategory->id }}</td>
            <td>{{ $subcategory->name }}</td>
            <td>{{ $subcategory->category->name ?? '-' }}</td>
            <td>{{ $subcategory->created_at->format('Y-m-d') }}</td>
            <td>
              <a href="{{ route('subcategory.edit', $subcategory->id) }}" class="btn btn-sm text-white" style="background-color: #00CFE8;">Edit</a>
              <form action="{{ route('subcategory.destroy', $subcategory->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this subcategory?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm text-white" style="background-color: #FF4C51;">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-center">No subcategories found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-3 ms-3">
    {{ $subcategories->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection

@section('scripts')
<script>
  setTimeout(() => {
    const alert = document.getElementById('success-alert');
    if (alert) {
      alert.classList.remove('show');
      alert.classList.add('fade');
      setTimeout(() => alert.remove(), 500);
    }
  }, 2000);
</script>
@endsection
