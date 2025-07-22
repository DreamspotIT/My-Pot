@extends('layouts/contentNavbarLayout')

@section('title', 'FAQ List')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">FAQ List</h5>
    <a href="{{ route('faqs.create') }}" class="btn btn-primary btn-sm">Add FAQ</a>
  </div>

  {{-- ✅ Success Alert --}}
  @if (session('success'))
  <div class="alert alert-success alert-dismissible fade show m-3" role="alert" id="success-alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle mb-0">
<thead class="table-light">
  <tr>
    <th>ID</th>
    <th>Question</th>
    <th>Answer</th>
    <th>Status</th>
    <th>Actions</th>
  </tr>
</thead>
<tbody>
  @forelse($faqs as $faq)
  <tr>
    <td>{{ $faq->id }}</td> <!-- Real ID from DB -->
    <td>{{ $faq->question }}</td>
<td>{!! nl2br(e($faq->answer)) !!}</td>
    <td>
<span class="badge bg-{{ $faq->status == 1 ? 'success' : 'secondary' }}">
  {{ $faq->status == 1 ? 'Active' : 'Inactive' }}
</span>
    </td>
<td>
  <div class="d-flex gap-1">
    <a href="{{ route('faqs.show', $faq->id) }}" class="btn btn-sm btn-secondary">View</a>
    <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-sm btn-info">Edit</a>
    <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-sm btn-danger">Delete</button>
    </form>
  </div>
</td>
  </tr>
  @empty
  <tr>
    <td colspan="5" class="text-center">No FAQs available.</td>
  </tr>
  @endforelse
</tbody>
    </table>
  </div>

  {{-- ✅ Pagination --}}
  <div class="mt-3 ms-3">
{{ $faqs->links('pagination::bootstrap-5') }}
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
