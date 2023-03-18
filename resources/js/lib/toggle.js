export default function (element, toggleClass) {
    if (element.classList.contains(toggleClass)) {
        element.classList.remove(toggleClass);
    } else {
        element.classList.add(toggleClass);
    }
}
