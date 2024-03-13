<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class TodoController extends Controller
{
    /**
     * 一覧画面
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // todoテーブルの全データ取得
        $todos = Todo::all();
        // テーブルの行ごとに連想配列にする[id=>1,title=>aaa,…],[id=>2,…]みたいな
        $todos_array = $todos -> toArray();
        //更新日をCarbonで表記変更して、元の配列に格納する。
        foreach($todos_array as $key => $todo){
            $carbon_date = new Carbon($todo['updated_at']);
            $todos_array[$key]['updated_at']=$carbon_date->format('Y-m-d');
        }

        // 今日の日付とdeadlineを比較してflgをbladeに渡す
        $today = new Carbon('today');

        foreach($todos_array as $key => $todo){
            $deadline = new Carbon($todo['deadline']);
            // $date_over_flg = $today -> lt($carbon_date);
            // $todos_array[$key]->add('date_over_flg');
            $todos_array[$key]['date_over_flg'] = $today->gt($deadline);  // 締切日が今日より前ならtrue
        }

        return view('todos.index',['todos' => $todos_array]);

        }
        // return view('todos.index', compact('todos_array',));
        // return view('todos.index',['todos' => $todos_array,'date_over_flg' => $date_over_flg]);
    // }

    /**
     * 新規登録画面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * 新規登録ボタン押下処理
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //入力された内容をtodosテーブルに登録する
        try {
            DB::beginTransaction(); //トランザクション開始
            $post = new Todo();
            $post->todo_title = $request->todo_title;
            $post->todo_content = $request->todo_content ?? '';
            $post->deadline =  $request->deadline ?? '';
            $post->save();
            DB::commit(); //全部無事に更新できたらまとめてDBにコミット
            return redirect()->route('todos.index');
        } catch (\Exception $e) {
            DB::rollBack(); //もしトランザクション中に例外エラーがあったらロールバック
        }
        return back()->withInput(); //エラー時は入力値をセッションに保持し前のページにリダイレクト
    }

    /**
     * 詳細ページ表示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //詳細ページの表示
        $todo = Todo::find($id);
        return view('todos.show', compact('todo'));
    }

    /**
     * 詳細編集画面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $todo = Todo::find($id);
        return view('todos.edit', compact('todo'));

        //編集画面への遷移(showページをそのままinputタグのtextにする。withInputで再読み込み)
        // $todo = Todo::find($id);
        // return redirect()->withInput();
    }

    /**
     * 更新ボタン押下時処理
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //更新ボタンを押した時の処理
        try {
            DB::beginTransaction();
            $todo = Todo::find($id);
            $todo->todo_title = $request->todo_title;
            $todo->todo_content = $request->todo_content;
            $todo->deadline = $request->deadline;
            $todo->save();
            DB::commit();
            return redirect()->route('todos.index');
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return back()->withInput();
    }

    /**
     * 削除ボタン押下時処理
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //削除ボタンを押した時の処理
        try {
            DB::beginTransaction();
            Todo::destroy($id);
            DB::commit();
            return redirect()->route('todos.index');
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return back()->withInput();
    }
}
