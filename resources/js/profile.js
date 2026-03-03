import { id, selectors, event } from './module.js';

const infoContainers = [...selectors('.information .info')];

event(document, 'DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);

    let changePasswordStatus = urlParams.get('changePasswordStatus');

    if (changePasswordStatus === 'error') {
        const passwordInfo = id('password-info');

        openChangeForm(passwordInfo.querySelector('.title .change'), null, passwordInfo.querySelector('.value form'))
    }
});

infoContainers.forEach(info => {
    const changeBtn = info.querySelector('.title .change');

    if (changeBtn !== null) {
        event(changeBtn, 'click', () => openChangeForm(
            changeBtn,
            info.querySelector('.value').firstElementChild,
            info.querySelector('.value form'))
        );
    }
});

function openChangeForm(changeBtn, value, changeForm) {
    changeBtn.classList.add('hidden');

    if (value !== null) {
        value.classList.add('hidden');
    }

    changeForm.classList.remove('hidden!');

    event(changeForm.querySelector('.btns').lastElementChild, 'click', () => {
        changeForm.classList.add('hidden!');
        changeBtn.classList.remove('hidden');

        if (value !== null) {
            value.classList.remove('hidden');
        }
    });
}
