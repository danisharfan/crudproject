@extends('layouts.layout')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background: #f5f6fa;">
    <div class="card shadow-lg border-0" style="width: 420px; border-radius: 14px;">
        
        <div class="card-header text-center bg-primary text-white" style="border-radius: 14px 14px 0 0;">
            <h4 class="mb-0 fw-bold">Login</h4>
        </div>

        <div class="card-body p-4">
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.action') }}" method="POST" class="user">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input name="email" type="email" 
                           class="form-control" 
                           placeholder="Enter your email..." required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input name="password" type="password" 
                           class="form-control" 
                           placeholder="Enter your password..." required>
                </div>

                <div class="form-check mb-3">
                    <input name="remember" class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">
                        Remember Me
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                    Login
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
