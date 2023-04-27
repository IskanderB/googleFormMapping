const mainCheckbox = document.querySelector('.row-checkbox__main');

if (mainCheckbox) {
    mainCheckbox.addEventListener('change', event => {
        const mainChecked = event.target.checked;

        if (mainChecked === false) {
            return;
        }

        document.querySelectorAll('.row-checkbox__item').forEach(checkbox => {
            checkbox.checked = mainChecked;
        });
    });

    document.querySelectorAll('.row-checkbox__item').forEach(checkbox => {
        checkbox.addEventListener('change', event => {
            mainCheckbox.checked = isAllChecked();
        });
    });

    const isAllChecked = () => {
        return document.querySelectorAll('.row-checkbox__item').length === document.querySelectorAll('.row-checkbox__item:checked').length;
    };
}
