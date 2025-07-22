@extends('layouts/contentNavbarLayout')

@section('title', 'Verify OTP')

@section('page-style')
@vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('content')
<div class="row justify-content-center mt-5">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow px-sm-4 px-2">
      <div class="card-body">
        <h4 class="mb-2 text-center">Verify OTP 🔐</h4>
        <p class="mb-4 text-center">Please enter the 6-digit OTP sent to your mobile or email.</p>

        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <form method="POST" action="{{ route('verify-otp.submit') }}">
          @csrf
          <div class="mb-3">
            <label for="otp" class="form-label">OTP</label>
            <input
              type="text"
              name="otp"
              class="form-control"
              placeholder="Enter OTP"
              required
              maxlength="6"
              minlength="6"
              autofocus
            >
          </div>

          <div class="mb-3">
            <button type="submit" class="btn btn-primary d-grid w-100">Verify</button>
          </div>
        </form>

        <p class="text-center mt-3">
          <a href="{{ route('customer.create') }}" class="text-muted">← Back to Register</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
