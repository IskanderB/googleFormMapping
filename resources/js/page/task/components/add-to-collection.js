import addFormToCollection from '../../../lib/add-form-to-collection'
import autowriteSlug from "../../../lib/autowrite-slug";

let addButton = document.querySelector('.task-form__add-button');

if (addButton) {
    addButton.addEventListener('click', event => {
        addFormToCollection(event);

        autowriteSlug(
            'task-form__sluggable-input',
            'task-form__sluggable-target',
            'task-form__collection--row',
            '{',
            '}'
        );
    });

    let collectionContainer = document.getElementById('task_form_replacebleFields');

    if (Number(collectionContainer.dataset.index) === 0) {
        addButton.click();
    }
}
