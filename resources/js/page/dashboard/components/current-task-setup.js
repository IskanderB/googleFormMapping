document.querySelectorAll('.tasks__item').forEach(task => {
    if (!task.classList.contains('shadow-active')) {
        return;
    }

    task.scrollIntoView();
});
