<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'Панель управления' }}
        </h2>
    </x-slot>

    <div class="container mt-8">
        <div class="content">
            <div class="tasks">
                <div class="tasks__list">
                    @foreach($tasks as $task)
                        <div class="tasks__item">
                            <span>{{ $task->getName() }}</span>
                            <a href="{{ route('task', ['task' => $task->getId()]) }}" target="_blank">
                                <svg class="tasks__icon-settings">
                                    <use xlink:href="#icon-settings"></use>
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('task') }}" class="button">Добавить задачу</a>
            </div>
            <div class="applications">
                <div class="applications__item">
                    <div class="applications__checkbox">
                        <input type="checkbox">
                    </div>
                    <div class="applications__column font-semibold">{{ $task->getPreview() }}</div>
                    <div class="applications__column">
                        <form id="task-refresh-form" class="max-h-0" action="{{ route('task.refresh', ['currentTask' => $task->getId()]) }}">
                            <button class="applications__action">
                                <svg class="applications__icon-refresh">
                                    <use xlink:href="#icon-refresh"></use>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                @foreach($task->getRows() as $row)
                    <div class="applications__item">
                        <div class="applications__checkbox">
                            <input type="checkbox">
                        </div>
                        <div class="applications__column">{{ $row->getContent()->getContent()[$task->getPreview()] ?? 'Нет совпадений с превью' }}</div>
                        <div class="applications__column">
                            <a class="applications__action" href="#">
                                <svg class="applications__icon-document-create">
                                    <use xlink:href="#icon-document-create"></use>
                                </svg>
                            </a>
                            <a class="applications__action" href="#">
                                <svg class="applications__icon-document-ready">
                                    <use xlink:href="#icon-document-ready"></use>
                                </svg>
                            </a>
                            <a class="applications__action" href="#">
                                <svg class="applications__icon-refresh">
                                    <use xlink:href="#icon-refresh"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

