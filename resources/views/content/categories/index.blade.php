@extends('layouts/contentNavbarLayout')

@section('title', 'Category List')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Category List</h5>
    <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm">Add Category</a>
  </div>

  {{-- ✅ Success Alert --}}
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show m-3" role="alert" id="success-alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Category Name</th>
          <th>Rate/Gram</th>
          <th>Rate Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($categories as $category)
        <tr>
          <td>{{ $category->id }}</td>
          <td>{{ $category->name }}</td>
          <td>{{ $category->rate_per_gram ?? '-' }}</td>
          <td>{{ $category->rate_date ? \Carbon\Carbon::parse($category->rate_date)->format('d-m-Y') : '-' }}</td>
          <td>
            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm text-white" style="background-color: #00CFE8;">Edit</a>
            <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this category?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm text-white" style="background-color: #FF4C51;">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="text-center">No categories found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- ✅ Pagination --}}
<div class="mt-3 ms-3">
  {{ $categories->links('pagination::bootstrap-5') }}
</div>
@endsection

@section('scripts')
<script>
  setTimeout(function () {
    const alert = document.getElementById('success-alert');
    if (alert) {
      alert.classList.remove('show');
      alert.classList.add('fade');
      setTimeout(() => { alert.remove(); }, 500);
    }
  }, 2000);
</script>
@endsection
