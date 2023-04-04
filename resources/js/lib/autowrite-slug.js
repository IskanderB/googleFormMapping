import slug from 'slug';

export default function (sluggableInputClass, targetInputClass, containerClass, prefix = '', suffix = '') {
    let sluggableInputs = document.querySelectorAll(`.${sluggableInputClass}`);

    sluggableInputs.forEach(sluggableInput => {
        sluggableInput.addEventListener('input', event => {
            let sluggableInput = event.target;
            let container = sluggableInput.closest(`.${containerClass}`);
            let targetInput = container.querySelector(`.${targetInputClass}`);

            targetInput.value = sluggableInput.value
                ? prefix + slug(sluggableInput.value) + suffix
                : '';
        });
    });
}
