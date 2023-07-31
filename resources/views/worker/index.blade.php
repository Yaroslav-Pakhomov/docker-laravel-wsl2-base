<x-layout-app>
    <h1>Index</h1>
    <div>
        <div>
            <a href="{{ route('workers.create') }}">Создать рабочего</a>
        </div>

        {{--  Поиск - начало  --}}

        <form method="GET" action="{{ route('workers.index') }}">
            @csrf

            <h3>Поиск</h3>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <label for="name"></label>
            <input id="name" type="text" name="name" class="" placeholder="Имя" value="{{ request()->get('name') }}">

            <label for="surname"></label>
            <input id="surname" type="text" name="surname" class="" placeholder="Фамилия"
                   value="{{ request()->get('surname') }}">

            <label for="email"></label>
            <input id="email" type="email" name="email" class="" placeholder="Почта"
                   value="{{ request()->get('email') }}">

            <label for="age_from"></label>
            <input id="age_from" type="text" name="age_from" class="" placeholder="Возраст от"
                   value="{{ request()->get('age_from') }}">

            <label for="age_to"></label>
            <input id="age_to" type="text" name="age_to" class="" placeholder="Возраст до"
                   value="{{ request()->get('age_to') }}">

            <label for="description"></label>
            <input id="description" type="text" name="description" class="" placeholder="Описание"
                   value="{{ request()->get('description') }}">

            <input id="is_married" type="checkbox" name="is_married" class=""
                   placeholder="Имя" {{ !empty(request()->get('is_married')) ? 'checked' : '' }}>
            <label for="is_married">Женат/Замужем</label>


            <input type="submit" id="worker_create" value="Отправить">
            <a href="{{ route('workers.index') }}">Сбросить</a>

        </form>

        {{--  Поиск - конец  --}}

        <hr>

        <div class="my_nav">
            {{ $workers->withQueryString()->links() }}
        </div>

        <hr>

        <div>
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

        <div class="my_nav">
            {{ $workers->withQueryString()->links() }}
        </div>

        <hr>

    </div>
    <style>
        .my_nav svg {
            width: 20px;
        }

        .my_nav a {
            margin: 0 5px;
        }
    </style>
</x-layout-app>
