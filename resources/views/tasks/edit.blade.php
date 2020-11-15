@extends('layouts.app')

@section('content')

    <h1>id: {{ $taskHenshu->id }} のメッセージ編集ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($taskHenshu, ['route' => ['tasks.update', $taskHenshu->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('content', 'タスク:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('status', '進捗:') !!}
                    {!! Form::text('status', null, ['class' => 'form-control']) !!}
                </div>

                
                

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection