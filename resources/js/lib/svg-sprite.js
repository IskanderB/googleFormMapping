fetch(require('../../images/sprite.svg'))
    .then((response) => response.text())
    .then((svg) => {
        document.body.insertAdjacentHTML('afterbegin', `<div class="svg-sprite">${svg}</div>`);
    })
    .catch(console.error.bind(console));
