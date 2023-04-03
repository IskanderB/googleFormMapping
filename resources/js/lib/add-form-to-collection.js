import addTagFormDeleteLink from './add-tag-form-delete-link';
export default function (e) {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

    const item = document.createElement('div');

    item.innerHTML = collectionHolder
        .dataset
        .prototype
        .replace(
            /__name__/g,
            collectionHolder.dataset.index
        );

    addTagFormDeleteLink(item.firstChild);

    collectionHolder.appendChild(item.firstChild);

    collectionHolder.dataset.index++;
}
