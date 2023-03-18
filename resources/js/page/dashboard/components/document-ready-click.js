document.querySelectorAll('.applications__icon-document-ready').forEach(button => {
    button.addEventListener('click', (event) => {
        let container =  event.target.closest('.applications__item');

        if (container === null) {
            return;
        }

        let toggle = container.querySelector('.applications__icon-drop-down');

        toggle.click();
    });
});
