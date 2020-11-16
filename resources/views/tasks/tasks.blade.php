<h1>タスク一覧</h1>

    @if (count($taskIchiran) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>タスク</th>
                    <th>進捗</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($taskIchiran as $task)
                <tr>
                    
                    {{-- 1.ルーティング名 2.リンクの文字列 3.URLパラメーターに代入したい値 --}}
                    
                    <td>{{ link_to_route('tasks.show',$task->id,['task' => $task->id]) }}</td>
                    <td>{{ $task->content }}</td>
                    <td>{{ $task->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    {{-- タスク作成ページへのリンク --}}
    {!! link_to_route('tasks.create', 'タスクの登録', [], ['class' => 'btn btn-primary']) !!}
    


