@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/admin.css') }}">
@endsection

@section('nav')
<nav class="logout__button">
    <form action="/logout" class="logout-form" method="post">
    @csrf
    <button class='logout__button-btn'onclick="location.href='{{ route('logout') }}'">logout</button>
    </form>
    
</nav>
@endsection

@section('content')
<main>
@if(session('delete'))
<p class="delete-message">{{ session('delete')}}</p>
@endif
    <div class="admin__heading">
        <p>Admin</p>
    </div>
    <div class="content__wrapper">
        <div class="search__content">
            <form action="{{ route('search') }}" class="search-form" method="get">
                @csrf
                <input name="keyword" type="text" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
                <select name="gender" id="">
                    <option value="" disabled selected>性別</option>  
                    <option value=""  {{ request('gender') == '' ? 'selected' : ''}} >全て</option>  
                    <option value="1" {{ request('gender') == 1 ? 'selected' : ''}} >男性</option>
                    <option value="2" {{ request('gender') == 2 ? 'selected' : ''}} >女性</option>
                    <option value="3" {{ request('gender') == 3 ? 'selected' : ''}} >その他</option>
                </select>
                <select name="category_id" id="">
                    <option value="" disable selected>お問い合わせの種類</option>
                    @foreach($categories as $category)
                    <option class="category_id"  value="{{ $category->id }}"{{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
                    @endforeach
                </select>
                <input type="date" name="created_at" value="{{ request('created_at') }}">
                <button class="search-button__btn" type="submit">検索</button>
                <input type="button" class="search__content--reset" value="リセット" onclick="location.href='{{ route('admin') }}'">
            </form>
            
        </div>
        <div class="admin-utilities">
            <div class="export__button">
                <form action="{{ route('export') }}" class="contact-export" method="post">
                    @csrf
                    <input type="submit" class="export__button-btn" value="エクスポート">
                </form>
            </div>
            {{ $contacts->links('pagination::bootstrap-4') }}
        </div>

        
        <div class="admin__content">
            <table class="admin__content-table">
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの内容</th>
                    <th></th>
                </tr>
                @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->last_name . ' ' . $contact->first_name }}</td>
                    <td>{{ $contact->gender_label }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content }}</td>
                    <td>
                        <div class="modal-2__wrap">
                            <input type="radio" id="modal-2__open-{{ $loop->index }}" class="modal-2__open-input" name="modal-2__trigger-{{ $loop->index }}"/>
                            <label for="modal-2__open-{{ $loop->index }}" class="modal-2__open-label">詳細</label>
                            <input type="radio" id="modal-2__close-{{ $loop->index }}" name="modal-2__trigger-{{ $loop->index }}"/>
                            <div class="modal-2">
                                <div class="modal-2__content-wrap">
                                    <label for="modal-2__close-{{ $loop->index }}" class="modal-2__close-label">×</label>
                                    <div class="modal-2__content">
                                        <dl class="contact__content">
                                            <div class="contact__content-item">
                                                <dt class="contact__content-title">お名前</dt>
                                                <dd class="contact__content-text">{{ $contact->last_name . ' ' . $contact->first_name }}</dd>
                                            </div>
                                            <div class="contact__content-item">
                                                <dt class="contact__content-title">性別</dt>
                                                <dd class="contact__content-text">{{ $contact->gender_label }}</dd>
                                            </div>
                                            <div class="contact__content-item">
                                                <dt class="contact__content-title">メールアドレス</dt>
                                                <dd class="contact__content-text">{{ $contact->email }}</dd>
                                            </div>
                                            <div class="contact__content-item">
                                                <dt class="contact__content-title">電話番号</dt>
                                                <dd class="contact__content-text">{{ $contact->tel }}</dd>
                                            </div>
                                            <div class="contact__content-item">
                                                <dt class="contact__content-title">住所</dt>
                                                <dd class="contact__content-text">{{ $contact->address }}</dd>
                                            </div>
                                            <div class="contact__content-item">
                                                <dt class="contact__content-title">建物名</dt>
                                                <dd class="contact__content-text">{{ $contact->building }}</dd>
                                            </div>
                                            <div class="contact__content-item">
                                                <dt class="contact__content-title">お問い合わせの種類</dt>
                                                <dd class="contact__content-text">{{ $contact->category->content }}</dd>
                                            </div>
                                            <div class="contact__content-item">
                                                <dt class="contact__content-title">お問い合わせ内容</dt>
                                                <dd class="contact__content-text">{{ $contact->detail }}</dd>
                                            </div>   
                                        </dl>
                                    </div>
                                    <form action="{{ route('destroy') }}" class="delete-form" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <div class="delete__button">
                                            <input type="hidden" name="id" value="{{ $contact->id }}">
                                            <button class="delete__button-btn">削除</button>
                                        </div>
                                    </form>
                                </div>
                                <label for="modal-2__close-{{ $loop->index }}">
                                    <div class="modal-2__background"></div>
                                </label>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</main>
@endsection