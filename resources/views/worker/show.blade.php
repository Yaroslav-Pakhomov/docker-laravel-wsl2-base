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
            <br>
            <div>
                <a href="{{ route('workers.index') }}">Назад</a>

                {{-- Проверка политики редактирования у пользователя --}}
                @can('update', $worker)
                    <a href="{{ route('workers.edit', $worker) }}">Редактировать</a>
                @endcan

                {{-- Проверка политики удаления у пользователя --}}
                @can('delete', $worker)
                    <br>
                    <br>
                    <form method="POST" action="{{ route('workers.delete', $worker) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" id="worker_edit" value="Удалить">
                    </form>
                @endcan

            </div>
        </div>
        <hr>
    </div>
@endsection
