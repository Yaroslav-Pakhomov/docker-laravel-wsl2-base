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
<h1>Редактирование рабочего</h1>

{{--@dump($worker)--}}
<form method="POST" action="{{ route('workers.update', $worker) }}">
    @csrf
    @method('PATCH')
    <label for="name">Имя</label>
    <br>
    <input id="name" type="text" name="name" class=""
           value="{{ old('name', $worker->name) }}">
    <br>
    <br>
    <label for="surname">Фамилия</label>
    <br>
    <input id="surname" type="text" name="surname" class=""
           value="{{ old('surname', $worker->surname) }}">
    <br>
    <br>
    <label for="email">Почта e-mail</label>
    <br>
    <input id="email" type="email" name="email" class=""
           value="{{ old('email', $worker->email) }}">
    <br>
    <br>
    <label for="age">Возраст</label>
    <br>
    <input id="age" type="text" name="age" class=""
           value="{{ old('age', $worker->age) }}">
    <br>
    <br>
    <label for="description">Описание</label>
    <br>
    <textarea id="description" name="description" class="">
        {{ old('description', $worker->description) }}
    </textarea>
    <br><br>
    <input id="is_married" type="checkbox" name="is_married" class=""
        {{old('is_married', $worker->is_married) ? 'checked' : ''}}
    >
    <label for="is_married">Женат/Замужем</label>
    <br>
    <br>
    <br>

    <input type="submit" id="worker_edit" value="Отправить">

</form>
</body>
</html>
