export default function (item) {
    const removeFormButtonClass = 'form__collection--remove-button';
    const prototype = '<svg><use xlink:href="#icon-trash"></use></svg>'

    if (item.querySelector(`.${removeFormButtonClass}`)) {
        return;
    }

    const removeFormButton = document.createElement('button');
    removeFormButton.classList.add(removeFormButtonClass);
    removeFormButton.innerHTML = prototype;

    item.append(removeFormButton);

    removeFormButton.addEventListener('click', (e) => {
        e.preventDefault();

        item.remove();
    });
}
