@extends('layouts/contentNavbarLayout')

@section('title', 'Item Offers')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Offer List</h5>
    <a href="{{ route('gold-offers.create') }}" class="btn btn-sm btn-primary">Add  Offer</a>
  </div>

  {{-- ✅ Success Alert --}}
  @if (session('success'))
  <div class="alert alert-success alert-dismissible fade show mx-4 mt-3" role="alert" id="success-alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <div class="table-responsive p-3">
    <table class="table table-bordered table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Description</th>
          <th>Discount %</th>
          <th>Duration</th>
          <th>Actions</th>
        </tr>
      </thead>
<tbody>
  @forelse($offers as $offer)
  <tr>
    <td class="text-center">{{ $offer->id }}</td>
    <td>{{ $offer->title }}</td>
    <td>{{ $offer->description }}</td>
    <td class="text-center">{{ $offer->discount }}%</td>
    <td class="text-center">{{ $offer->start_date }} to {{ $offer->end_date }}</td>
    <td class="text-center">
      <div class="d-flex justify-content-center gap-1">
        <a href="{{ route('gold-offers.show', $offer->id) }}" class="btn btn-sm btn-secondary">View</a>
        <a href="{{ route('gold-offers.edit', $offer->id) }}" class="btn btn-sm text-white" style="background-color: #00CFE8;">Edit</a>
        <form action="{{ route('gold-offers.destroy', $offer->id) }}" method="POST">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-sm text-white" style="background-color: #FF4C51;">Delete</button>
        </form>
      </div>
    </td>
  </tr>
  @empty
  <tr>
    <td colspan="6" class="text-center text-muted">No offers found.</td>
  </tr>
  @endforelse
</tbody>
    </table>
  </div>
</div>
{{-- ✅ Pagination --}}
  <div class="mt-3 ms-3">
    {{ $offers->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection
