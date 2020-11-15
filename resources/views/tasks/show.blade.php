@extends('layouts.app')

@section('content')


<h1>id = {{ $taskShousai->id }} のメッセージ詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $taskShousai->id }}</td>
        </tr>
        <tr>
            <th>タスク</th>
            <td>{{ $taskShousai->content }}</td>
        </tr>
        <tr>
            <th>進捗</th>
            <td>{{ $taskShousai->status }}</td>
        </tr>

    </table>
    
    
    
     {{-- メッセージ編集ページへのリンク --}}
     
      {{-- 1.ルーティング名 2.リンクの文字列 3.URLパラメーターに代入したい値 4.クラス --}}
     
    {!! link_to_route('tasks.edit', 'このタスクを編集', ['task' => $taskShousai->id], ['class' => 'btn btn-light']) !!}


    {{-- メッセージ削除フォーム --}}
    {!! Form::model($taskShousai, ['route' => ['tasks.destroy', $taskShousai->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}



@endsection