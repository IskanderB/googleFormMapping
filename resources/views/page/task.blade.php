<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'Создание задачи' }}
        </h2>
    </x-slot>
    <div class="container">
        @formStart($form)
        @formWidget($form)
{{--        <input name="task_form[fields][1][sheetKey]">--}}
{{--        <input name="task_form[fields][1][documentKey]">--}}
{{--        <br>--}}
{{--        <br>--}}
{{--        <input name="task_form[fields][1][sheetKey]">--}}
{{--        <input name="task_form[fields][1][documentKey]">--}}
        @formEnd($form)
    </div>
</x-app-layout>
