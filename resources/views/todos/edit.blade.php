@extends("layouts.app")
@section("content")
@endsection

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Todo</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
    <div class="container">
        <h3 class="my-3">TODOアプリ</h3>
        <div class="card">
            <div class="card-header">
                編集画面
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('todos.update', $todo->id ) }}" >
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="id" class="form-label">ID</label>
                        <div>{{ $todo->id }}</div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="form-label">タイトル</label>
                        <input type="text" name="todo_title" class="form-control" value="{{ $todo->todo_title }}">
                        <label for="content" class="form-label">内容</label>
                        <input type="text" name="todo_content" class="form-control" value="{{ $todo->todo_content }}">
                        <label for="content" class="form-label">締切</label>
                        <input type="date" name="deadline" class="form-control" value="{{$todo->deadline}}">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success">更新</button>
                    </div>
                </form>
                <a href="{{ route('todos.index') }}">一覧へ</a>
            </div>
        </div>
    </div>
</body>

</html>
