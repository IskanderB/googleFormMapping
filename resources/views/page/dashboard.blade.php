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
                <div class="applications__header">
                    <div class="applications__checkbox">
                        <input type="checkbox">
                    </div>
                    <div class="applications__column font-semibold">{{ $currentTask ? $currentTask->getPreviewField()->getSheetKey() : 'Превью' }}</div>
                    <div class="applications__column">
                        <div class="applications__actions">
                            <div class="applications__actions--group">
                                <div class="applications__action" href="#">
                                    <svg class="applications__icon-document-ready">
                                        <use xlink:href="#icon-document-ready"></use>
                                    </svg>
                                </div>
                                <div class="applications__action" href="#">
                                    <svg class="applications__icon-document-trash">
                                        <use xlink:href="#icon-trash"></use>
                                    </svg>
                                </div>
                            </div>
                            <div class="applications__actions--group">
                                @if($currentTask !== null)
                                    <form id="task-refresh-form" class="max-h-0" action="{{ route('task.refresh', ['currentTask' => $currentTask->getId()]) }}">
                                        <button>
                                            <svg class="applications__icon-refresh">
                                                <use xlink:href="#icon-refresh"></use>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($currentTask->getRows() as $row)
                    <div class="applications__item">
                        <div class="applications__preview">
                            <div class="applications__checkbox">
                                <input type="checkbox">
                            </div>
                            <div class="applications__column">{{ $row->getContent()[$currentTask->getPreviewField()->getSheetKey()] ?? 'Нет совпадений с превью' }}</div>
                            <div class="applications__column">
                                <div class="applications__actions">
                                    <div class="applications__actions--group">
                                        @if($row->getDocuments()->isEmpty())
                                            <form class="max-h-0 documents-create-form" action="{{ route('row.documents.generate', ['row' => $row->getId()]) }}">
                                                <button class="applications__action">
                                                    <svg class="applications__icon-document-create">
                                                        <use xlink:href="#icon-document-create"></use>
                                                    </svg>
                                                </button>
                                            </form>
{{--                                            <a class="applications__action" href="#">--}}
{{--                                                <svg class="applications__icon-document-create">--}}
{{--                                                    <use xlink:href="#icon-document-create"></use>--}}
{{--                                                </svg>--}}
{{--                                            </a>--}}
                                        @else
                                            <div class="applications__action" href="#">
                                                <svg class="applications__icon-document-ready">
                                                    <use xlink:href="#icon-document-ready"></use>
                                                </svg>
                                            </div>
                                            <div class="applications__action" href="#">
                                                <svg class="applications__icon-document-trash">
                                                    <use xlink:href="#icon-trash"></use>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="applications__actions--group">
                                        <div class="applications__icon-drop applications__icon-drop-up hidden">
                                            <svg>
                                                <use xlink:href="#icon-drop-up"></use>
                                            </svg>
                                        </div>
                                        <div class="applications__icon-drop applications__icon-drop-down">
                                            <svg>
                                                <use xlink:href="#icon-drop-down"></use>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                            <a class="applications__action" href="#">--}}
{{--                                <svg class="applications__icon-refresh">--}}
{{--                                    <use xlink:href="#icon-refresh"></use>--}}
{{--                                </svg>--}}
{{--                            </a>--}}
                        <div class="applications__details hidden">
                            @if($row->getDocuments()->isEmpty() === false)
                                <div class="applications__documents">
                                    <div class="applications__details--header">Документы</div>
                                    <div class="applications__documents--list">
                                        @foreach($row->getDocuments() as $document)
                                            <a href="{{ route('file.show', ['file' => $document->getUuid()]) }}" target="_blank" class="applications__documents--item">
                                                <span class="applications__documents--name">{{ Str::limit($document->getOriginalName(), 50) }}</span>
                                                <svg class="">
                                                    <use xlink:href="#icon-share"></use>
                                                </svg>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="applications__data">
                                <div class="applications__details--header">Данные</div>
                                <div class="applications__data--list">
                                    @foreach($row->getContent() as $key => $value)
                                        <div class="applications__data--item">
                                            <div class="applications__data--key">{{ Str::limit($key, 25) }}</div>
                                            <div class="applications__data--value">{{ Str::limit($value, 75) }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

