<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'Создание задачи' }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="task-form">
            @php
                /**
                * @var \Symfony\Component\Form\FormView $form
                */

                /** @var App\Entity\Task\Task $task */
                $task = $form->vars['data'];

                $taskLocked = $task?->getLock()?->getLockedUntil() > new DateTime;
            @endphp

            @formStart($form)

            <div class="task-form__row">
                @formLabel($form['name'], 'Название задачи', [
                    'label_attr' => [
                        'class' => 'task-form__label',
                    ],
                ])
{{--                <a href="#">--}}
{{--                    <svg>--}}
{{--                        <use xlink:href="#icon-question"></use>--}}
{{--                    </svg>--}}
{{--                </a>--}}
                @formWidget($form['name'], [
                    'attr' => [
                        'class' => 'task-form__input',
                    ],
                ])
            </div>
            <div class="task-form__row">
                @formLabel($form['spreadsheetId'], 'Ссылка на таблицу', [
                    'label_attr' => [
                        'class' => 'task-form__label',
                    ],
                ])
                @formWidget($form['spreadsheetId'], [
                    'attr' => [
                        'class' => 'task-form__input',
                    ],
                ])
            </div>
            <div class="task-form__row">
                @formLabel($form['indexField']['documentKey'], 'Ключ в шаблоне для порядкового номера документа', [
                    'label_attr' => [
                        'class' => 'task-form__label',
                    ],
                ])
                @formWidget($form['indexField']['documentKey'], [
                    'attr' => [
                        'class' => 'task-form__input',
                    ],
                ])
            </div>
            <div class="task-form__row">
                @formLabel($form['previewField']['sheetKey'], 'Поле таблицы, которое будет отображаться как превью', [
                    'label_attr' => [
                        'class' => 'task-form__label',
                    ],
                ])
                @formWidget($form['previewField']['sheetKey'], [
                    'attr' => [
                        'class' => 'task-form__input',
                    ],
                ])
            </div>
            <div class="task-form__row">
                @formLabel($form['layouts'], 'Шаблоны документов', [
                    'label_attr' => [
                        'class' => 'task-form__label',
                    ],
                ])

                @if($task->getLayouts()->isEmpty() === false)
                    <div class="task-form__file-list">
                        @foreach($task->getLayouts() as $layout)
                            <div class="task-form__file">
                                <a href="{{ route('file.show', ['file' => $layout->getUuid()]) }}" target="_blank" class="task-form__file--item">
                                    <span class="task-form__file--name">{{ Str::limit($layout->getOriginalName(), 50) }}</span>
                                    <svg class="">
                                        <use xlink:href="#icon-share"></use>
                                    </svg>
                                </a>
                                @if($taskLocked === false)
                                    <button
                                        class="task-form__file--icon-trash"
                                        data-action="{{ route('task.layout.remove', ['currentTask' => $task->getId(), 'layout' => $layout->getId()]) }}"
                                        type="button"
                                    >
                                        <svg>
                                            <use xlink:href="#icon-trash"></use>
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif

                @formWidget($form['layouts'], [
                    'attr' => [
                        'class' => 'task-form__file-input',
                    ],
                ])
            </div>
            <div class="task-form__collection">
                @formLabel($form['replacebleFields'], 'Ключи в шаблоне и поля таблицы для автозаполнения', [
                    'label_attr' => [
                        'class' => 'task-form__collection--label',
                    ],
                ])
                @formWidget($form['replacebleFields'], [
                    'attr' => [
                        'class' => 'task-form__collection--container',
                        'data-index' => count($form['replacebleFields']),
                    ],
                ])
                <button class="task-form__add-button" type="button" data-collection-holder-class="task-form__collection--container">
                    <svg>
                        <use xlink:href="#icon-add"></use>
                    </svg>
                </button>
            </div>

            <div class="task-form__save">
                @if($taskLocked)
                    <div class="task-form__save-help">
                        Задача находится в процессе обновления, после его окончания вы сможете изменить данные
                    </div>
                @else
                    <div class="task-form__button-list">
                        <div class="task-form__button-group">
                            <button class="task-form__save-button" type="submit">Сохранить задачу</button>
                        </div>
                        @if($task->getId())
                            <div class="task-form__button-group">
                                <button class="task-form__remove-button" type="button">Удалить задачу</button>
                                <div class="task-form__remove-agree--box hidden">
                                    <div class="task-form__remove-agree">
                                        <div class="task-form__remove-agree--question">Вы уверены, что хотите удалить задачу?</div>
                                        <button
                                            type="button"
                                            class="task-form__remove-agree--button-agree"
                                            data-action="{{ route('task.remove', ['currentTask' => $task->getId()]) }}"
                                        >
                                            Да
                                        </button>
                                        <button type="button" class="task-form__remove-agree--button-disagree">Нет</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            @formEnd($form)
        </div>
    </div>
</x-app-layout>
