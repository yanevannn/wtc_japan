@extends('layouts.app')

@section('title', 'Login akun : WTC 2 JAPAN')

@section('content')
<div class="flex h-screen">
    <!-- Left Pane -->
    <div class="hidden lg:flex items-center justify-center flex-1 bg-white text-black">
        <div class="max-w-md text-center">
            <img src="{{ asset('assets/login.svg') }}" alt="Login Image" class="h-[700px]">
        </div>
    </div>
    <!-- Right Pane -->
    <div class="w-full bg-gray-100 lg:w-1/2 flex items-center justify-center">
        @include('components.login-form')
    </div>
</div>
@endsection