<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

//Todoリスト一覧取得のAPI
class TodoListController extends Controller{
    public function index(Request $request){
        // $word = $_GET['word'];
        // $todos = $word ? Todo::where(title: $word) : Todo::all();
        $query = $request->query();
        $word = $query ? $query['word'] : '';
        // Log::debug($query['word']);//表示確認用
        // Log::debug($query['test']);
        // $todos = $word ? Todo::where('todo_title', '=','bbbbb') : Todo::all();
        $todos = $word === '' ? Todo::all() : Todo::where('todo_title', '=',$word)->get();
        // $todos = Todo::all();


        return response() -> json($todos);
    }

    public function Search(Request $request){

    }
}
