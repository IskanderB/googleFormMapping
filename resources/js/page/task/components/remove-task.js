import toggle from "../../../lib/toggle";
import getCsrf from "../../../lib/get-csrf";

let removeTaskButton = document.querySelector('.task-form__remove-button');
let agreeBox = document.querySelector('.task-form__remove-agree--box');
let agreeButton = document.querySelector('.task-form__remove-agree--button-agree');
let disagreeButton = document.querySelector('.task-form__remove-agree--button-disagree');

removeTaskButton.addEventListener('click', event => {
    toggle(removeTaskButton, 'hidden');
    toggle(agreeBox, 'hidden');
});

agreeButton.addEventListener('click', async event => {
    event.preventDefault();

    let button = event.target.closest('.task-form__remove-agree--button-agree');

    let response = await fetch(button.dataset.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': getCsrf(),
        },
    });

    if (response.ok) {
        let json = await response.json();
        window.location.href = json.redirectUrl;
    }
});

disagreeButton.addEventListener('click', event => {
    toggle(removeTaskButton, 'hidden');
    toggle(agreeBox, 'hidden');
});
