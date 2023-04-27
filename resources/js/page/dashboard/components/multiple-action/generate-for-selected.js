import getCsrf from '../../../../lib/get-csrf';
import toggle from "../../../../lib/toggle";
import getSelection from "../../../../lib/get-selection";

let documentsCreateForm = document.querySelector('.documents-multiple-create-form');

if (documentsCreateForm) {
    documentsCreateForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const selection = getSelectionForGeneration();
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
            item.dataset.generate = '';

            let refreshIcon = item.querySelector('.documents-create-form');
            let loadingIcon = item.querySelector('.applications__icon-loading');

            toggle(refreshIcon, 'hidden');

            if (response.ok) {
                toggle(loadingIcon, 'hidden');
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

    const getSelectionForGeneration = () => {
        const selection = getSelection('row-checkbox__item', 'applications__item');

        let selectionForGeneration = [];

        selection.forEach(item => {
            if (!item.dataset.generate) {
                return;
            }

            selectionForGeneration.push(item);
        })

        return selectionForGeneration;
    };
}
