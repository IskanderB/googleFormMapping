import addFormToCollection from '../../../lib/add-form-to-collection'

let addButton = document.querySelector('.task-form__add-button');

if (addButton) {
    addButton.addEventListener('click', addFormToCollection);

    let collectionContainer = document.getElementById('task_form_replacebleFields');

    if (Number(collectionContainer.dataset.index) === 0) {
        addButton.click();
    }
}
