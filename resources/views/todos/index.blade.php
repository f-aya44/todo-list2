@extends("layouts.base")
@section("content")
    <div id="index" hidden>{{$todos.map((todo)=>{
        const todo_array = todo.index
    })}}</div>
@endsection

@section('resource')
    @vite('resources/ts/components/Index.tsx')
@endsection

    {{-- <div class="container">
        <h3 class="my-3">TODOアプリ</h3>
        <div class="card">
            <div class="card-header">TODO一覧</div>

            <div class="card-body">
                <a href="{{route('todos.create')}}" class="btn btn-success mb-3">新規作成</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>タイトル</th>
                            <th>内容</th>
                            <th>作成日時</th>
                            <th>締切</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos as $todo)
                            <tr>
                                <td>{{$todo['id']}}</td>
                                <td>{{$todo['todo_title']}}</td>
                                <td>{{$todo['todo_content']}}</td>
                                <td>{{$todo['updated_at']}}</td>
                                @if($todo['date_over_flg']){
                                    <td class="text-danger bg-warning">{{$todo['deadline']}}</td>
                                }
                                @else
                                    <td>{{$todo['deadline']}}</td>
                                @endif
                                <td><a href="{{route('todos.show',$todo['id'])}}" class="btn btn-primary mb-3">詳細</a></mb-3></td>
                                <td><a href="{{route('todos.edit',$todo['id'])}}" class="btn btn-primary mb-3">編集</a></mb-3></td>
                            <td>
                                <form method="post" action="{{route('todos.destroy',$todo['id'])}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">削除</button>
                                 </form>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}

