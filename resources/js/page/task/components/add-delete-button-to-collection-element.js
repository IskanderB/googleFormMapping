import addTagFormDeleteLink from '../../../lib/add-tag-form-delete-link';

document.addEventListener('DOMContentLoaded', function(){
    document
        .querySelectorAll('.task-form__collection--container fieldset')
        .forEach((element) => {
            addTagFormDeleteLink(element)
        })
});
