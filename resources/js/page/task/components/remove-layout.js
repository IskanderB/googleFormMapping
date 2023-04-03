import getCsrf from '../../../lib/get-csrf';

let layoutRemoveButtons = document.querySelectorAll('.task-form__file--icon-trash');

layoutRemoveButtons.forEach(button => {
    button.addEventListener('click', async (event) => {
        event.preventDefault();

        let container = event.target.closest('.task-form__file');
        let button = container.querySelector('.task-form__file--icon-trash');

        let response = await fetch(button.dataset.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': getCsrf(),
            },
        });

        if (response.ok) {
            container.remove();
        }
    });
});
