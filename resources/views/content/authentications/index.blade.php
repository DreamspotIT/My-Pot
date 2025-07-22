@extends('layouts/blankLayout')

@section('title', 'Login - Digigold')

@section('page-style')
@vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<style>
  /* Fade-in animation for whole page */
.auth-split-container {
  animation: fadeIn 0.7s ease-in-out;
}

/* Slide-up effect for the form */
.auth-form-wrapper {
  opacity: 0;
  transform: translateY(30px);
  animation: slideUp 0.8s ease-out forwards;
  animation-delay: 0.2s;
}

/* Button pulse animation on hover */
.btn-primary {
  position: relative;
  overflow: hidden;
  transition: background 0.3s ease, transform 0.2s;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(105, 108, 255, 0.4);
}

/* Input zoom on focus */
.auth-form-wrapper input.form-control:focus {
  transform: scale(1.02);
}

/* Password eye icon hover */
.input-group-text:hover {
  background-color: #f0f0ff;
  cursor: pointer;
}

/* Animations */
@keyframes fadeIn {
  0% { opacity: 0 }
  100% { opacity: 1 }
}

@keyframes slideUp {
  0% { transform: translateY(30px); opacity: 0 }
  100% { transform: translateY(0); opacity: 1 }
}
.fade-in {
  animation: fadeIn 1s ease-in-out;
}

  body {
    background-color: #f4f5fa;
  }

  .auth-split-container {
    display: flex;
    min-height: 100vh;
    overflow: hidden;
  }

  .auth-left-image {
    width: 45%;
    background: url('{{ asset("assets/img/images/digi-login.png") }}') no-repeat center center;
    background-size: cover;
  }

  .auth-right-form {
    width: 55%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2.5rem;
    background-color: #f4f5fa;
  }

  .auth-form-wrapper {
    width: 100%;
    max-width: 500px;
    background: #fff;
    border-radius: 12px;
    padding: 2rem 2.5rem;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07);
  }

  .auth-form-wrapper input.form-control {
    border: 1px solid #ced4da;
    border-radius: 0.5rem;
    transition: all 0.2s ease-in-out;
  }

  .auth-form-wrapper input.form-control:focus {
    border-color: #696cff;
    box-shadow: 0 0 0 0.2rem rgba(105, 108, 255, 0.25);
  }

  .btn-primary {
    background-color: #696cff;
    border-color: #696cff;
    border-radius: 0.5rem;
    box-shadow: 0 4px 10px rgba(105, 108, 255, 0.3);
    transition: all 0.2s ease-in-out;
  }

  .btn-primary:hover {
    background-color: #5f62e4;
    border-color: #5f62e4;
  }

  .text-heading {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
  }

  .divider {
    display: flex;
    align-items: center;
    margin: 1.5rem 0;
    text-align: center;
  }

  .divider::before,
  .divider::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid #dcdce3;
  }

  .divider:not(:empty)::before {
    margin-right: 1rem;
  }

  .divider:not(:empty)::after {
    margin-left: 1rem;
  }

  .social-icons {
    display: flex;
    justify-content: center;
    gap: 0.75rem;
    margin-top: 1rem;
  }

  .social-icons a {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 22px;
    color: #fff;
    transition: 0.3s ease;
  }

  .icon-facebook { background-color: #3b5998; }
  .icon-twitter { background-color: #1da1f2; }
  .icon-github { background-color: #24292e; }
  .icon-google { background-color: #db4437; }

  .social-icons a:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }

  .buy-now {
    position: fixed;
    bottom: 24px;
    right: 24px;
    background-color: #ff3e1d;
    color: #fff;
    padding: 12px 24px;
    border-radius: 40px;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(255, 62, 29, 0.4);
    z-index: 1000;
    transition: background-color 0.3s;
  }

  .buy-now:hover {
    background-color: #e63819;
  }

  @media (max-width: 992px) {
    .auth-split-container {
      flex-direction: column;
    }

    .auth-left-image {
      display: none;
    }

    .auth-right-form {
      width: 100%;
      padding: 2rem 1.5rem;
    }

    .auth-form-wrapper {
      border-radius: 10px;
      box-shadow: none;
    }
  }
</style>
@endsection

@section('content')
<div class="auth-split-container">
  <!-- Left Side Image -->
  <div class="auth-left-image"></div>

  <!-- Right Side Form -->
  <div class="auth-right-form">
    <div class="auth-form-wrapper">
      <!-- Logo -->
      <div class="mb-4">
        <h4 class="text-heading">Welcome to Digigold! 👋</h4>
        <p class="text-muted">Please sign-in to your account and start the adventure</p>
      </div>

      <!-- Login Form -->
<form id="formAuthentication" action="{{ route('login.process') }}" method="POST">
  @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email :</label>
          <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus />
        </div>

        <div class="mb-3 form-password-toggle">
          <label class="form-label" for="password">Password:</label>
          <div class="input-group input-group-merge">
            <input type="password" id="password" class="form-control" name="password" placeholder="••••••••" />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
          </div>
        </div>

        <!-- <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember-me" />
            <label class="form-check-label" for="remember-me">Remember Me</label>
          </div>
          <a href="{{ url('auth/forgot-password-basic') }}">Forgot Password?</a>
        </div>
 -->
        <button class="btn btn-primary w-100 mb-3" type="submit">Sign in</button>
      </form>

      <!-- <p class="text-center mb-2">
        New on our platform? <a href="{{ url('auth/register-basic') }}">Create an account</a>
      </p> -->

      <!-- Divider
      <div class="divider">or</div> -->

      <!-- Social Icons -->
<div class="social-icons">
  <a href="#" class="icon-facebook"><i class='bx bxl-facebook'></i></a>
  <a href="#" class="icon-twitter"><i class='bx bxl-twitter'></i></a>
  <a href="#" class="icon-github"><i class='bx bxl-github'></i></a>
  <a href="#" class="icon-google"><i class='bx bxl-google'></i></a>
</div>
    </div>
  </div>
</div>

<!-- Buy Now Button -->
<!-- <a href="#" class="buy-now">Buy Now</a> -->
@endsection
