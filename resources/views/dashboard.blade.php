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
                    <div class="tasks__item">
                        <span>Task №1</span>
                        <a href="#">
                            <svg class="tasks__icon-settings">
                                <use xlink:href="#icon-settings"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="tasks__item">
                        <span>Task №2</span>
                        <a href="#">
                            <svg class="tasks__icon-settings">
                                <use xlink:href="#icon-settings"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="tasks__item">
                        <span>Task №3</span>
                        <a href="#">
                            <svg class="tasks__icon-settings">
                                <use xlink:href="#icon-settings"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="tasks__item">
                        <span>Task №4</span>
                        <a href="#">
                            <svg class="tasks__icon-settings">
                                <use xlink:href="#icon-settings"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="tasks__item">
                        <span>Task №5</span>
                        <a href="#">
                            <svg class="tasks__icon-settings">
                                <use xlink:href="#icon-settings"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="tasks__item">
                        <span>Task №6</span>
                        <a href="#">
                            <svg class="tasks__icon-settings">
                                <use xlink:href="#icon-settings"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="tasks__item">
                        <span>Task №7</span>
                        <a href="#">
                            <svg class="tasks__icon-settings">
                                <use xlink:href="#icon-settings"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="tasks__item">
                        <span>Task №8</span>
                        <a href="#">
                            <svg class="tasks__icon-settings">
                                <use xlink:href="#icon-settings"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="tasks__item">
                        <span>Task №9</span>
                        <a href="#">
                            <svg class="tasks__icon-settings">
                                <use xlink:href="#icon-settings"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="tasks__item">
                        <span>Task №10</span>
                        <a href="#">
                            <svg class="tasks__icon-settings">
                                <use xlink:href="#icon-settings"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="tasks__item">
                        <span>Task №11</span>
                        <a href="#">
                            <svg class="tasks__icon-settings">
                                <use xlink:href="#icon-settings"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="tasks__item">
                        <span>Task №12</span>
                        <a href="#">
                            <svg class="tasks__icon-settings">
                                <use xlink:href="#icon-settings"></use>
                            </svg>
                        </a>
                    </div>
                </div>
                <a href="{{ route('task.create') }}" class="button">Добавить задачу</a>
            </div>
            <div class="applications">
                <div class="applications__item">
                    <div class="applications__checkbox">
                        <input type="checkbox">
                    </div>
                    <div class="applications__column font-semibold">ФИО</div>
                    <div class="applications__column font-semibold">Паспорт</div>
                    <div class="applications__column">
                        <a class="applications__action" href="#">
                            <svg class="applications__icon-document-create">
                                <use xlink:href="#icon-document-create"></use>
                            </svg>
                        </a>
                        <a class="applications__action" href="#">
                            <svg class="applications__icon-refresh">
                                <use xlink:href="#icon-refresh"></use>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="applications__item">
                    <div class="applications__checkbox">
                        <input type="checkbox">
                    </div>
                    <div class="applications__column">Application #1</div>
                    <div class="applications__column">Application #1</div>
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
                <div class="applications__item">
                    <div class="applications__checkbox">
                        <input type="checkbox">
                    </div>
                    <div class="applications__column">Application #2</div>
                    <div class="applications__column">Application #2</div>
                    <div class="applications__column"></div>
                </div>
                <div class="applications__item">
                    Application #3
                </div>
                <div class="applications__item">
                    Application #2
                </div>
                <div class="applications__item">
                    Application #1
                </div>
                <div class="applications__item">
                    Application #3
                </div>
                <div class="applications__item">
                    Application #2
                </div>
                <div class="applications__item">
                    Application #1
                </div>
                <div class="applications__item">
                    Application #3
                </div>
                <div class="applications__item">
                    Application #2
                </div>
                <div class="applications__item">
                    Application #1
                </div>
                <div class="applications__item">
                    Application #3
                </div>
                <div class="applications__item">
                    Application #2
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

