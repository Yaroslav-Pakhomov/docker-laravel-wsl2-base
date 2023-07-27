<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Base</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('laravel_icon.ico') }}">
</head>
<body>
<h1>Index</h1>
<div>
    <div>
        <a href="{{ route('workers.create') }}">Создать рабочего</a>
    </div>
    <hr>
    @foreach($workers as $worker)
        <div>
            <div>Name: {{ $worker->name }}</div>
            <div>Surname: {{ $worker->surname }}</div>
            <div>Email: {{ $worker->email }}</div>
            <div>Age: {{ $worker->age }}</div>
            <div>Description: {{ $worker->description }}</div>
            <div>Is married: {{ $worker->is_married }}</div>
            <div>
                <a href="{{ route('workers.show', $worker) }}">Перейти</a>
                <a href="{{ route('workers.edit', $worker) }}">Редактировать</a>
                <br>
                <br>
                <form method="POST" action="{{ route('workers.delete', $worker) }}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" id="worker_edit" value="Удалить">
                </form>
            </div>
        </div>
        <hr>
    @endforeach
</div>
</body>
</html>
