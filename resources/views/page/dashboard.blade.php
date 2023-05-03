@php

    use Illuminate\Contracts\Pagination\LengthAwarePaginator;

@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'Задачи' }}
        </h2>
    </x-slot>

    <div class="container mt-8">
        <div class="content">
            <div class="tasks">
                <div class="tasks__list">
                    @foreach($tasks as $task)
                        <div class="tasks__item">
                            <a href="{{ route('dashboard', ['currentTask' => $task->getId()]) }}">{{ $task->getName() }}</a>
                            <a href="{{ route('task', ['task' => $task->getId()]) }}" target="_blank">
                                <svg class="tasks__icon-settings">
                                    <use xlink:href="#icon-settings"></use>
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('task') }}" class="tasks__button">Добавить задачу</a>
            </div>
            <div class="applications">
                <div class="applications__header">
                    <div class="applications__checkbox">
                        <input type="checkbox" class="row-checkbox__main">
                    </div>
                    <div class="applications__column font-semibold">{{ $currentTask ? $currentTask->getPreviewField()->getSheetKey() : 'Превью' }}</div>
                    <div class="applications__column">
                        <div class="applications__actions">
                            <div class="applications__actions--group">
                                <div class="applications__action">
                                    <form
                                        class="max-h-0 documents-multiple-create-form"
                                        action="{{ route('row.documents.generate.multiple') }}"
                                    >
                                        <button>
                                            <svg class="applications__icon-document-create">
                                                <use xlink:href="#icon-document-create"></use>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                <form
                                    class="max-h-0 documents-multiple-remove-form"
                                    action="{{ route('row.documents.remove.multiple') }}"
                                >
                                    <button class="applications__action">
                                        <svg class="applications__icon-document-trash">
                                            <use xlink:href="#icon-trash"></use>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <div class="applications__actions--group">
                                @if($currentTask !== null)
                                    @php $currentTaskLocked = $currentTask->getLock()->getLockedUntil() > new DateTime; @endphp

                                    <form id="task-refresh-form" class="max-h-0 {{ $currentTaskLocked ? 'hidden' : '' }}" action="{{ route('task.refresh', ['currentTask' => $currentTask->getId()]) }}">
                                        <button>
                                            <svg class="applications__icon-refresh">
                                                <use xlink:href="#icon-refresh"></use>
                                            </svg>
                                        </button>
                                    </form>
                                    <div class="applications__icon-loading {{ $currentTaskLocked ? '' : 'hidden' }}">
                                        <img src="{{ Vite::asset('resources/images/loading.gif') }}" alt="">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if($currentTask !== null)
                    @php

                        /**
                         * @var LengthAwarePaginator $rowPaginator
                         */

                    @endphp
                    @foreach($rowPaginator->items() as $row)
                        @php $rowLocked = $row->getLock()->getLockedUntil() > new DateTime @endphp
                        @php $documentsReady = $row->getDocuments()->count() >= $currentTask->getLayouts()->count() @endphp

                        <div
                            class="applications__item"
                            data-id="{{ $row->getId() }}"
                            data-generate="{{ !$rowLocked && !$documentsReady }}"
                            data-remove="{{ !$rowLocked && $documentsReady }}"
                        >
                            <div class="applications__preview">
                                <div class="applications__checkbox">
                                    <input type="checkbox" class="row-checkbox__item">
                                </div>
                                <div class="applications__column">{{ $row->getContent()[$currentTask->getPreviewField()->getSheetKey()] ?? 'Нет совпадений с превью' }}</div>
                                <div class="applications__column">
                                    <div class="applications__actions">
                                        <div class="applications__actions--group">
                                            <form
                                                class="max-h-0 documents-create-form {{ $rowLocked ? 'hidden' : '' }} {{ $documentsReady ? 'hidden' : '' }}"
                                                action="{{ route('row.documents.generate', ['row' => $row->getId()]) }}"
                                            >
                                                <button class="applications__action">
                                                    <svg class="applications__icon-document-create">
                                                        <use xlink:href="#icon-document-create"></use>
                                                    </svg>
                                                </button>
                                            </form>
                                            <div
                                                class="applications__action applications__icon-loading {{ $rowLocked ? '' : 'hidden' }} {{ $documentsReady ? 'hidden' : '' }}"
                                            >
                                                <img src="{{ Vite::asset('resources/images/loading.gif') }}" alt="">
                                            </div>
                                            <div class="applications__action applications__block-document-ready {{ $documentsReady ? '' : 'hidden' }}">
                                                <svg class="applications__icon-document-ready">
                                                    <use xlink:href="#icon-document-ready"></use>
                                                </svg>
                                            </div>
                                            <form
                                                class="max-h-0 documents-remove-form {{ $documentsReady ? '' : 'hidden' }}"
                                                action="{{ route('row.documents.remove', ['row' => $row->getId()]) }}"
                                            >
                                                <button class="applications__action">
                                                    <svg class="applications__icon-document-trash">
                                                        <use xlink:href="#icon-trash"></use>
                                                    </svg>
                                                </button>
                                            </form>
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
                @endif
                @php

                    $limitPage = 4;
                    $currentPage = $rowPaginator->currentPage();
                    $lastPage = $rowPaginator->lastPage();

                    $firstRangedPage = max($currentPage - $limitPage + 1, 1);
                    $lastRangedPage = min($firstRangedPage + $limitPage, $rowPaginator->lastPage());

                    $pageUrlRange = $rowPaginator->getUrlRange($firstRangedPage, $lastRangedPage);

                @endphp
                @if($lastPage > 1)
                    <div class="pagination">
                        <div class="pagination__list">
                            @if($firstRangedPage > 1)
                                <a href="{{ $rowPaginator->url(1) }}" class="pagination__number--wrap bg-base-gray">
                                    <div class="pagination__number">1</div>
                                </a>
                                <div class="pagination__break">
                                    ...
                                </div>
                            @endif
                            @foreach($pageUrlRange as $pageNumber => $pageUrl)
                                <a href="{{ $pageUrl }}" class="pagination__number--wrap {{ $pageNumber === $currentPage ? 'bg-black' : 'bg-base-gray' }}">
                                    <div class="pagination__number">{{ $pageNumber }}</div>
                                </a>
                            @endforeach
                            @if($lastPage > $lastRangedPage)
                                <div class="pagination__break">
                                    ...
                                </div>
                                <a href="{{ $rowPaginator->url($lastPage) }}" class="pagination__number--wrap bg-base-gray">
                                    <div class="pagination__number">{{ $lastPage }}</div>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

