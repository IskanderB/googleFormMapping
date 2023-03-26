import getCsrf from '../../../lib/get-csrf';

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

        if (response.ok) {
            let json = await response.json();

            console.log(json);
        } else {
            console.log('Refresh failed');
        }
    });
});
