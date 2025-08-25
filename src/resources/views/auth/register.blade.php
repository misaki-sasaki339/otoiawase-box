@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('nav')
<nav class="login__button">
    <button class='login__button-btn'onclick="location.href='{{ route('login') }}'">login</button>
</nav>
@endsection

@section('content')
<main>
    <div class="register-form__heading">
        <p>Register</p>
    </div>
    <div class="register-form__content">
        <form action="{{ route('register') }}" class="form" method="post">
        @csrf
            <div class="form__group">
                <div class="form-group__title">
                    <span class="form__label--item">お名前</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="name" placeholder="例: 山田  太郎" />
                        @error('name')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
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
                    <button class="form__button-submit" type="submit">登録</button>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection