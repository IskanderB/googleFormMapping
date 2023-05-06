<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'Пользователи' }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="users">
            <div class="users__container">
                <a href="{{ route('add.user') }}" class="users__add-button">Добавить пользователя</a>
                @foreach($users as $user)
                    <div class="users__item">
                        <div>{{ $user->getEmail() }}</div>
                        @if(in_array(\App\Enum\Role::ROLE_ADMIN->value, $user->getRoles()) === false)
                            <a href="{{ route('user.remove', ['user' => $user->getId()]) }}" class="users__remove-button" type="button">Удалить</a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>
