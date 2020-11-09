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
        //
        $taskIchiran = Task::all();
        
        return view('tasks.index',['taskIchiran' => $taskIchiran,]);
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
        
        //  task.show.bladeに渡す
        return view('tasks.show',['taskShousai' => $taskShousai]);
        
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
        
        return view('tasks.edit',['taskHenshu' => $taskHenshu]);
        
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
        
        $taskUpdate->content = $request->content;
        $taskUpdate->status = $request->status;
        $taskUpdate->save();
        
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
        //
        $taskDelete = Task::findOrFail($id);
        
        $taskDelete->delete();
        return redirect('/');
    }
}
