<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        /*
        タスクを全て取得し一覧でインデックスに表示
        $taskIchiran = Task::all();
        return view('tasks.index',['taskIchiran' => $taskIchiran,]);
        
        ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
        
        認証済みユーザーはタスクを新しい順に表示
        */
        
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            $taskIchiran = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'taskIchiran' => $taskIchiran,
            ];
        }

        // Welcomeビューでログイン済なら$data配列を表示に使える
        // Welcomeビューで未ログインなら通常のwelcomページを表示
        
        return view('welcome', $data);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //tinkerのインスタンス生成の構文とおなじ
        $taskMake = new Task;
        
        //  task.create.bladeに渡す
        return view('tasks.create',['taskMake' => $taskMake,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        /*
        
        $request->validate([ 
            'content' => 'required|max:255',
            'status' => 'required|max:10',
            ]);
        
        //$requestはPOSTみたいなもの
        //tinkerのインスタンス生成、上書き、保存
        
        $tasksave = new Task;
        $tasksave->content = $request->content;
        $tasksave->status = $request->status;
        $tasksave->save();
        
        //登録したらトップにリダイレクト
        return redirect('/');
        
        ↓↓↓↓↓↓↓↓↓↓↓↓↓

        */
        
        //バリデーシ
        
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ]);
        
        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);
        
        // 前のURLへリダイレクトさせる
        return redirect('/');
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  リクエストのidを格納される　idがないとエラーに飛ばす関数
        $taskShousai = Task::findOrFail($id);
        
        //  自分の認証id=タスクのユーザーidなら（自分の投稿タスクなら）タスク詳細を表示
        if (\Auth::id() === $taskShousai->user_id) {
        
        //  task.show.bladeに渡す
        return view('tasks.show',['taskShousai' => $taskShousai]);
        
        }
        return redirect('/');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //showページから送られてきたidのedit（編集）ページに渡す処理
        $taskHenshu = Task::findOrFail($id);
        
        //  自分の認証id=タスクのユーザーidなら（自分の投稿タスクなら）編集ページを表示
        if (\Auth::id() === $taskHenshu->user_id) {
        
        return view('tasks.edit',['taskHenshu' => $taskHenshu]);
        
        }
        return redirect('/');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ]);
        
        //editページから送られてきたidのコンテンツをデータベースへ上書き保存
        $taskUpdate = Task::findOrFail($id);
        
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は上書き
        if (\Auth::id() === $taskUpdate->user_id) {
        
        $taskUpdate->content = $request->content;
        $taskUpdate->status = $request->status;
        $taskUpdate->save();
        
        }
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*
        $taskDelete = Task::findOrFail($id);
        
        $taskDelete->delete();
        return redirect('/');
        */
        
 
        // idの値で投稿を検索して取得
        $task = \App\Task::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (\Auth::id() === $task->user_id) {
            $task->delete();
        }

        // 前のURLへリダイレクトさせる
        return redirect('/');
        
        
        
        
        
        
    }
}
