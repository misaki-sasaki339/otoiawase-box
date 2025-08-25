@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('nav')
<nav class="register__button">
    <button class='register__button-btn'onclick="location.href='{{ route('register') }}'">register</button>
</nav>
@endsection

@section('content')
<main>
@if(session('success'))
<p class="success-message">{{ session('success')}}</p>
@endif
    <div class="login-form___heading">
        <p>Login</p>
    </div>
    <div class="login-form__content">
        <form action="{{ route('login') }}" class="form" method="post">
        @csrf
            <div class="form__group">
                <div class="form-group__title">
                    <span class="form__label--item">メールアドレス</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="email" placeholder="例: test@example.com" />
                        @error('email')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-group__title">
                    <span class="form__label--item">パスワード</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" name="password" placeholder="例: coachtech1106" />
                        @error('password')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">ログイン</button>
                </div>
            </div>
        </form>
    </div>
</div>
</main>
@endsection