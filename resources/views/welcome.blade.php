@extends('layouts.app')

@section('content')

    {{-- 認証済みのユーザーならこれを表示 --}}
    @if (Auth::check())
        {{-- {{ Auth::user()->name }} --}}
        
        
        @include('tasks.tasks')
        
        
        
    {{-- 認証済みじゃないユーザーならこれを表示 --}}    
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Microposts</h1>
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection


