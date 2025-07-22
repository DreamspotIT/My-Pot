@extends('layouts/contentNavbarLayout')

@section('title', 'Items List')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Item List</h5>
    <a href="{{ route('gold-items.create') }}" class="btn btn-primary btn-sm">Add Item</a>
  </div>

  {{-- ✅ Success Alert --}}
  @if (session('success'))
  <div class="alert alert-success alert-dismissible fade show m-3" role="alert" id="success-alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  {{-- ✅ Scrollable Table --}}
<table class="table table-bordered table-hover align-middle mb-0">
  <thead class="table-light">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Category</th>
      <th>Subcategory</th>
      <th>Price (₹)</th>
      <th>Discount (%)</th>
      <th>Weight (gm)</th>
      <th>Purity</th>
      <th>Image</th>
      <th>Description</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @forelse($goldItems as $item)
    <tr>
      <td>{{ $item->id }}</td>
      <td>{{ $item->name }}</td>
      <td>{{ $item->category->name ?? '-' }}</td>
      <td>{{ $item->subcategory->name ?? '-' }}</td>
      <td>{{ $item->price }}</td>
      <td>{{ $item->discount ?? '0.00' }}%</td>
      <td>{{ $item->weight }} gm</td>
      <td>{{ $item->purity }}{{ is_numeric($item->purity) ? 'K' : '' }}</td>
      <td>
        @if ($item->image)
          <img src="{{ asset('storage/' . $item->image) }}" alt="Image" width="50" height="50" class="rounded">
        @else
          <span class="text-muted">No image</span>
        @endif
      </td>
      <td>{{ $item->description }}</td>
      <td>
        <div class="d-flex">
          <a href="{{ route('gold-items.show', $item->id) }}" class="btn btn-sm btn-secondary text-white me-1">View</a>
          <a href="{{ route('gold-items.edit', $item->id) }}" class="btn btn-sm text-white me-1" style="background-color: #00CFE8;">Edit</a>
          <form action="{{ route('gold-items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this item?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm text-white" style="background-color: #FF4C51;">Delete</button>
          </form>
        </div>
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="11" class="text-center">No items found.</td>
    </tr>
    @endforelse
  </tbody>
</table>
  </div>

  {{-- ✅ Pagination --}}
  <div class="mt-3 ms-3">
    {{ $goldItems->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection

@section('scripts')
<script>
  // Auto-dismiss success alert after 2 seconds
  setTimeout(function () {
    const alert = document.getElementById('success-alert');
    if (alert) {
      alert.classList.remove('show');
      alert.classList.add('fade');
      setTimeout(() => {
        alert.remove();
      }, 500);
    }
  }, 2000);
</script>
@endsection
