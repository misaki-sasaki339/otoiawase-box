@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<main>
<div class="contact-form__content">
    <div class="contact-form__heading">
        <p>Contact</p>
    </div>
    <form class="form" action="{{ route('confirm') }}" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <div class="input__name-wrapper">
                        <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}"/>
                        @error('first_name')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input__name-wrapper">
                        <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}"/>
                        @error('last_name')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--radio">
                    <label><input type="radio" name="gender" value="1" {{ old('gender','1') == 1 ? 'checked' : ''}}>男性</label>
                    <label><input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}>女性</label>
                    <label><input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}>その他</label>
                </div>
                @error('gender')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="email" placeholder="例: test@example.com" value="{{ old('email') }}"/>
                </div>
                @error('email')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">                        
                    <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}"/><span> - </span>
                    <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}"/><span> - </span>
                    <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}"/>
                </div>
                @error('tel')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}"/>  
                </div>
                @error('address')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}"/>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__item-select">
                    <select class="form__item-select--option" name="category_id">
                        <option value="" disabled selected>お問い合わせの種類</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}"{{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content}}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="detail" placeholder="お問い合わせの内容をご記載ください">{{ old('detail') }}</textarea>
                </div>
                @error('detail')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
</main>
@endsection