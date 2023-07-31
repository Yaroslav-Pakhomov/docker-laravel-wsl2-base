<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Профиль</h1>
<div>
    <hr>
    <div>
        <div>Name: {{ $worker->name }}</div>
        <div>Surname: {{ $worker->surname }}</div>
        <div>Email: {{ $worker->email }}</div>
        <div>Age: {{ $worker->age }}</div>
        <div>Description: {{ $worker->description }}</div>
        <div>Is married: {{ $worker->is_married }}</div>
        <div>
            <a href="{{ route('workers.index') }}">Назад</a>
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
</div>
</body>
</html>