@extends('layouts/contentNavbarLayout')

@section('title', 'Item Discounts')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0"> Discounts List</h5>
    <a href="{{ route('discounts.create') }}" class="btn btn-primary btn-sm">Add Discount</a>
  </div>

  {{-- ✅ Success Alert --}}
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show m-3" role="alert" id="success-alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
      <thead class="table-light">
        <tr>
          <th>Name</th>
          <th>Percentage (%)</th>
          <th>Code</th>
          <th>Min Purchase (₹)</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($discounts as $discount)
        <tr>
          <td>{{ $discount->name }}</td>
          <td>{{ $discount->percentage }}%</td>
          <td>{{ $discount->code ?? '-' }}</td>
          <td>{{ $discount->min_purchase ?? '-' }}</td>
          <td>{{ $discount->start_date ?? '-' }}</td>
          <td>{{ $discount->end_date ?? '-' }}</td>
          <td>
            @if($discount->is_active)
              <span class="badge bg-success">Active</span>
            @else
              <span class="badge bg-secondary">Inactive</span>
            @endif
          </td>
          <td>
             <a href="{{ route('discounts.show', $discount->id) }}" class="btn btn-sm btn-secondary text-white">View</a>
             <a href="{{ route('discounts.edit', $discount->id) }}" class="btn btn-sm text-white" style="background-color: #00CFE8;">Edit</a>
            <form action="{{ route('discounts.destroy', $discount->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this discount?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm text-white" style="background-color: #FF4C51;">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" class="text-center">No discounts available.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
{{-- ✅ Pagination --}}
  <div class="mt-3 ms-3">
    {{ $discounts->links('pagination::bootstrap-5') }}
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
