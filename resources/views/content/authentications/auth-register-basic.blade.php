@extends('layouts/blankLayout')

@section('title', 'Register')

@section('page-style')
@vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register Card -->
      <div class="card px-sm-6 px-0">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-6">
            <a href="{{ url('/') }}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
              <!-- <span class="app-brand-text demo text-heading fw-bold">{{ config('variables.templateName') }}</span> -->
                              <span class="app-brand-text demo text-heading fw-bold">Digigold</span>

            </a>
          </div>
          <!-- /Logo -->

          <h4 class="mb-1">Adventure starts here 🚀</h4>
          <p class="mb-6">Create your account</p>

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Phone</label>
              <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>
            <div class="mb-3">
              <label for="gender" class="form-label">Gender</label>
              <select name="gender" class="form-control" required>
                <option value="">Select Gender</option>
                <option value="male" {{ old('gender')=='male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender')=='female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender')=='other' ? 'selected' : '' }}>Other</option>
              </select>
            </div>
            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" name="password" class="form-control" required>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Confirm Password</label>
              <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            {{-- Optional role --}}
            <input type="hidden" name="role" value="user">

            <button class="btn btn-primary w-100">Register</button>
          </form>

          <p class="text-center mt-4">
            <span>Already have an account?</span>
            <a href="{{ route('auth-login-basic') }}">Sign in</a>
          </p>
        </div>
      </div>
      <!-- /Register Card -->
    </div>
  </div>
</div>
@endsection
