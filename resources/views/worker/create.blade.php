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
<h1>Создание рабочего</h1>

<form method="POST" action="{{ route('workers.store') }}">
    @csrf
    <label for="name">Имя</label>
    <br>
    <input id="name" type="text" name="name" class="">
    <br>
    <br>
    <label for="surname">Фамилия</label>
    <br>
    <input id="surname" type="text" name="surname" class="">
    <br>
    <br>
    <label for="email">Почта e-mail</label>
    <br>
    <input id="email" type="email" name="email" class="">
    <br>
    <br>
    <label for="age">Возраст</label>
    <br>
    <input id="age" type="text" name="age" class="">
    <br>
    <br>
    <label for="description">Описание</label>
    <br>
    <textarea id="description" name="description" class=""></textarea>
    <br><br>
    <input id="is_married" type="checkbox" name="is_married" class="">
    <label for="is_married">Женат/Замужем</label>
    <br>
    <br>
    <br>

    <input type="submit" id="worker_create" value="Отправить">

</form>


{{--<div>--}}
{{--    <hr>--}}
{{--        <div>--}}
{{--            <div>Name: {{ $worker->name }}</div>--}}
{{--            <div>Surname: {{ $worker->surname }}</div>--}}
{{--            <div>Email: {{ $worker->email }}</div>--}}
{{--            <div>Age: {{ $worker->age }}</div>--}}
{{--            <div>Description: {{ $worker->description }}</div>--}}
{{--            <div>Is married: {{ $worker->is_married }}</div>--}}
{{--            <div><a href="{{ route('workers.index') }}">НАЗАД</a></div>--}}
{{--        </div>--}}
{{--        <hr>--}}
{{--</div>--}}
</body>
</html>
