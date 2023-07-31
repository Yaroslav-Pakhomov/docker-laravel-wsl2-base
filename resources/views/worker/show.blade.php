@extends('layout.layout-app')

@section('content')
    <h1>Профиль</h1>

    <div>
        <a href="{{ route('workers.index') }}">Главная</a>
    </div>
    <br>

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
@endsection
