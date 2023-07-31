<x-layout-app>
    <h1>Создание рабочего</h1>

    <div>
        <a href="{{ route('workers.index') }}">Главная</a>
    </div>
    <br>

    <form method="POST" action="{{ route('workers.store') }}">
        @csrf
        <div>
            <label for="name">Имя</label>
            <br>
            <input id="name" type="text" name="name" class="" value="{{ old('name') }}">
            @error('name')
            <div>
                {{ $message }}
            </div>
            @enderror
        </div>
        <br>
        <br>
        <div>
            <label for="surname">Фамилия</label>
            <br>
            <input id="surname" type="text" name="surname" class="" value="{{ old('surname') }}">
            @error('surname')
            <div>
                {{ $message }}
            </div>
            @enderror
        </div>
        <br>
        <br>
        <div>
            <label for="email">Почта e-mail</label>
            <br>
            <input id="email" type="email" name="email" class="" value="{{ old('email') }}">
            @error('email')
            <div>
                {{ $message }}
            </div>
            @enderror
        </div>
        <br>
        <br>
        <div>
            <label for="age">Возраст</label>
            <br>
            <input id="age" type="text" name="age" class="" value="{{ old('age') }}">
            @error('age')
            <div>
                {{ $message }}
            </div>
            @enderror
        </div>
        <br>
        <br>
        <div>
            <label for="description">Описание</label>
            <br>
            <textarea id="description" name="description" class="">{{ old('description') }}</textarea>
            @error('description')
            <div>
                {{ $message }}
            </div>
            @enderror
        </div>
        <br>
        <br>
        <div>
            <input id="is_married" type="checkbox" name="is_married"
                   class="" {{ !empty(old('is_married')) ? 'checked' : '' }}>
            <label for="is_married">Женат/Замужем</label>
            @error('is_married')
            <div>
                {{ $message }}
            </div>
            @enderror
        </div>
        <br>
        <br>
        <br>

        <input type="submit" id="worker_create" value="Отправить">

    </form>
</x-layout-app>
