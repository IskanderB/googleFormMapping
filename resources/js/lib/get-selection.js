export default function (checkboxClass, itemClass) {
    const checkboxes = document.querySelectorAll(`.${checkboxClass}`);

    let selection = [];

    checkboxes.forEach(checkbox => {
        if (checkbox.checked === false) {
            return;
        }

        selection.push(checkbox.closest(`.${itemClass}`));
    });

    return selection;
}
