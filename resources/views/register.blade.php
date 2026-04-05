@extends('layouts.layout')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background: #f5f6fa;">
    <div class="card shadow-lg border-0" style="width: 420px; border-radius: 14px;">
        
        <div class="card-header text-center bg-success text-white" style="border-radius: 14px 14px 0 0;">
            <h4 class="mb-0 fw-bold">Register</h4>
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

            <form action="{{ route('register.action') }}" method="POST" class="user">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Name</label>
                    <input name="name" type="text" 
                           class="form-control" 
                           placeholder="Enter your name..." 
                           value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input name="email" type="email" 
                           class="form-control" 
                           placeholder="Enter your email..." 
                           value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input name="password" type="password" 
                           class="form-control" 
                           placeholder="Enter your password..." required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Confirm Password</label>
                    <input name="password_confirmation" type="password" 
                           class="form-control" 
                           placeholder="Confirm your password..." required>
                </div>

                <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">
                    Register
                </button>

                <div class="text-center mt-3">
                    <span class="text-muted">Already have an account?</span>
                    <a href="{{ route('login') }}" class="text-primary fw-semibold">Login here</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection