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
                詳細画面
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="title" class="col-sm-2 col-form-label">タイトル</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="title"
                            value="{{ $todo->todo_title }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="content" class="col-sm-2 col-form-label">内容</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="content"
                            value="{{ $todo->todo_content }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="content" class="col-sm-2 col-form-label">締切</label>
                    <div class="col-sm-10">
                        <input type="date" readonly class="form-control-plaintext" id="deadline"
                            value="{{ $todo->deadline }}">
                    </div>
                </div>
                <a href=" {{ route('todos.index') }}">一覧へ</a>
            </div>
        </div>
    </div>
</body>

</html>
