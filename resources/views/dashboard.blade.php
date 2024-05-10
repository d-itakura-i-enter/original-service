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
                Welcome to the Board
            </div>
        </div>
    @endif
@endsection