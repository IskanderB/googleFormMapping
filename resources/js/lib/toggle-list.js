import toggle from './toggle';

export default function (toggleButtonClass, toggleReverseButtonClass, showClass, containerClass) {
    const toggleButtons = document.querySelectorAll(`.${toggleButtonClass}`);
    const toggleReverseButtons = document.querySelectorAll(`.${toggleReverseButtonClass}`);

    const toggle = (element, toggleClass) => {
        if (element.classList.contains(toggleClass)) {
            element.classList.remove(toggleClass);
        } else {
            element.classList.add(toggleClass);
        }
    };

    const handler = (event) => {
        let toggleButton = event.target.closest(`.${toggleButtonClass}`);
        toggleButton = toggleButton ? toggleButton : event.target.closest(`.${toggleReverseButtonClass}`)

        let container = toggleButton.closest(`.${containerClass}`);

        let toggleReverseButton = container.querySelector(
            toggleButton.classList.contains(toggleButtonClass)
                ? `.${toggleReverseButtonClass}`
                : `.${toggleButtonClass}`
        );
        let show = container.querySelector(`.${showClass}`);

        toggle(toggleButton, 'hidden');
        toggle(toggleReverseButton, 'hidden');
        toggle(show, 'hidden');
    };

    toggleButtons.forEach(button => {
        button.addEventListener('click', handler);
    });
    toggleReverseButtons.forEach(button => {
        button.addEventListener('click', handler);
    });
}
