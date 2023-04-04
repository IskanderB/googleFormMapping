import autowriteSlug from '../../../lib/autowrite-slug';

autowriteSlug(
    'task-form__sluggable-input',
    'task-form__sluggable-target',
    'task-form__collection--row',
    '{',
    '}'
    );

let indexField = document.getElementById('task_form_indexField_documentKey');

if (indexField && !indexField.value) {
    indexField.value = '{index-key}';
}
