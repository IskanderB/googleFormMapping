import getCsrf from '../../../lib/get-csrf';
import toggle from "../../../lib/toggle";

let taskRefreshForm = document.getElementById('task-refresh-form');

if (taskRefreshForm) {
    taskRefreshForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        let response = await fetch(event.target.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': getCsrf(),
            },
        });

        let container = event.target.closest('.applications__actions--group');
        let refreshIcon = container.querySelector('#task-refresh-form');
        let loadingIcon = container.querySelector('.applications__icon-loading');

        if (response.ok) {
            toggle(refreshIcon, 'hidden');
            toggle(loadingIcon, 'hidden');
        } else {
            toggle(refreshIcon, 'hidden');
        }
    });
}
