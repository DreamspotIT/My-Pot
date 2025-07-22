@php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
$containerNav = $containerNav ?? 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');
@endphp

@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
@else
<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
  <div class="{{$containerNav}}">
@endif

<style>
  .rate-box {
    padding: 6px 10px;
    border-radius: 10px;
    transition: box-shadow 0.3s ease, background-color 0.3s ease;
  }

  .rate-box:hover {
    background-color: #f8f9fa;
    box-shadow: 0 0 10px rgba(255, 193, 7, 0.4);
    animation: blink 0.5s alternate 2;
  }

  @keyframes blink {
    0% { opacity: 1; }
    100% { opacity: 0.7; }
  }
</style>

@if(isset($navbarFull))
  <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
    <a href="{{url('/')}}" class="app-brand-link gap-2">
      <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
      <span class="app-brand-text demo menu-text fw-bold text-heading">{{config('variables.templateName')}}</span>
    </a>
  </div>
@endif

@if(!isset($navbarHideToggle))
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
    <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
      <i class="bx bx-menu bx-md"></i>
    </a>
  </div>
@endif

<!-- Rate Section -->
<div class="navbar-nav align-items-center flex-wrap me-4">
  <div class="rate-box me-4 d-flex align-items-center">
    <span class="me-1 fs-5 text-warning">🟡</span>
    <div>
      <strong class="text-dark">Gold:</strong>
      <span class="fw-bold text-warning">₹{{ $goldRate ?? 'N/A' }} /g</span><br>
      <small class="text-muted">({{ $goldDate ?? 'No date' }})</small>
    </div>
  </div>

  <div class="rate-box d-flex align-items-center">
    <span class="me-1 fs-5 text-secondary">⚪</span>
    <div>
      <strong class="text-dark">Silver:</strong>
      <span class="fw-bold text-secondary">₹{{ $silverRate ?? 'N/A' }} /g</span><br>
      <small class="text-muted">({{ $silverDate ?? 'No date' }})</small>
    </div>
  </div>
</div>

<!-- User Info and Dropdown -->
<ul class="navbar-nav flex-row align-items-center ms-auto">
  <li class="nav-item d-flex align-items-center me-3">
    <div class="text-end">
      <h6 class="mb-0 fw-semibold">{{ Session::get('name') }}</h6>
      <small class="text-muted">{{ ucfirst(Session::get('role')) }}</small>
    </div>
  </li>

  <!-- User Dropdown -->
  <li class="nav-item navbar-dropdown dropdown-user dropdown">
    <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
      <div class="avatar avatar-online">
        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
      </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
      <li>
        <a class="dropdown-item" href="javascript:void(0);">
          <div class="d-flex align-items-center">
            <div class="avatar avatar-online me-3">
              <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
            </div>
            <div>
              <h6 class="mb-0">{{ Session::get('name') }}</h6>
              <small class="text-muted">{{ ucfirst(Session::get('role')) }}</small>
            </div>
          </div>
        </a>
      </li>
      <li><div class="dropdown-divider my-1"></div></li>
      <li>
        <a class="dropdown-item" href="{{ route('logout') }}">
          <i class="bx bx-power-off bx-md me-2 text-danger"></i><span class="text-danger fw-medium">Log Out</span>
        </a>
      </li>
    </ul>
  </li>
</ul>

@if(!isset($navbarDetached))
  </div>
@endif
</nav>
