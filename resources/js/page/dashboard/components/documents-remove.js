import getCsrf from '../../../lib/get-csrf';
import toggle from "../../../lib/toggle";

let documentsRemoveForms = document.querySelectorAll('.documents-remove-form');

documentsRemoveForms.forEach(form => {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        let response = await fetch(event.target.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': getCsrf(),
            },
        });

        let container = event.target.closest('.applications__item');
        let createDocumentsButton = container.querySelector('.documents-create-form');
        let readyDocumentsButton = container.querySelector('.applications__block-document-ready');
        let removeDocumentsButton = container.querySelector('.documents-remove-form');
        let documentsBlock = container.querySelector('.applications__documents');

        toggle(removeDocumentsButton, 'hidden');

        if (response.ok) {
            toggle(createDocumentsButton, 'hidden');
            toggle(readyDocumentsButton, 'hidden');
            toggle(documentsBlock, 'hidden');
        }
    });
});
