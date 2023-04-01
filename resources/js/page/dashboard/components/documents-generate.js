import getCsrf from '../../../lib/get-csrf';
import toggle from "../../../lib/toggle";

let documentsCreateForms = document.querySelectorAll('.documents-create-form');

documentsCreateForms.forEach(form => {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        let response = await fetch(event.target.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': getCsrf(),
            },
        });

        let container = event.target.closest('.applications__actions--group');
        let refreshIcon = container.querySelector('.documents-create-form');
        let loadingIcon = container.querySelector('.applications__icon-loading');

        if (response.ok) {
            toggle(refreshIcon, 'hidden');
            toggle(loadingIcon, 'hidden');
        } else {
            toggle(refreshIcon, 'hidden');
        }
    });
});
