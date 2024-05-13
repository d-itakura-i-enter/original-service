@extends('layouts.app')

@section('content')
    @if (Auth::check())
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
         </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <div class="row">
            <div class="col-sm-8">
                {{-- 投稿フォーム --}}
                @include('boards.form')
                {{-- 投稿一覧 --}}
                @include('boards.boards')
            </div>
        </div>
    @else
        <div class="center jumbotron">
            <div class="navbar-brand d-flex flex-row-reverse bd-highlight">
                一言掲示板へようこそ！
                {{-- ユーザー登録ページへのリンク --}}
                <div class="my-2"><a href="{{ route('register') }}" class="btn btn-primary normal-case">会員登録はこちら！</a></div>
                {{-- ログインページへのリンク --}}
                <div class="my-2"><a href="{{ route('login') }}" class="btn btn-accent normal-case">すでにアカウントをお持ちの方</a></div>
            </div>
        </div>
    @endif
@endsection