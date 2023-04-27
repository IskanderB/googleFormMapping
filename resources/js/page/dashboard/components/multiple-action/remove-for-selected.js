import getCsrf from '../../../../lib/get-csrf';
import toggle from "../../../../lib/toggle";
import getSelection from "../../../../lib/get-selection";

let documentsRemoveForm = document.querySelector('.documents-multiple-remove-form');

if (documentsRemoveForm) {
    documentsRemoveForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const selection = getSelectionForRemoving();
        const ids = getDataIds(selection);

        if (!ids) {
            return;
        }

        let response = await fetch(event.target.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': getCsrf(),
            },
            body: JSON.stringify({
                rowIds: ids,
            })
        });

        selection.forEach(item => {

            let createDocumentsButton = item.querySelector('.documents-create-form');
            let readyDocumentsButton = item.querySelector('.applications__block-document-ready');
            let removeDocumentsButton = item.querySelector('.documents-remove-form');
            let documentsBlock = item.querySelector('.applications__documents');

            toggle(removeDocumentsButton, 'hidden');

            if (response.ok) {
                item.dataset.remove = '';

                toggle(createDocumentsButton, 'hidden');
                toggle(readyDocumentsButton, 'hidden');
                toggle(documentsBlock, 'hidden');
            }
        });
    });

    const getDataIds = (selection) => {
        let ids = [];

        selection.forEach(item => {
            ids.push(item.dataset.id)
        });

        return ids;
    };

    const getSelectionForRemoving = () => {
        const selection = getSelection('row-checkbox__item', 'applications__item');

        let selectionForGeneration = [];

        selection.forEach(item => {
            if (!item.dataset.remove) {
                return;
            }

            selectionForGeneration.push(item);
        })

        return selectionForGeneration;
    };
}
