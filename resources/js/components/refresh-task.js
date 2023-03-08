import getCsrf from './get-csrf';

let taskRefreshForm = document.getElementById('task-refresh-form');
taskRefreshForm.addEventListener('submit', async (event) => {
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
