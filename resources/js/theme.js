import { get, set, id, selector, event } from './module.js';

const [
        themeBtn, html,
        profileSvg, vkSvg, telegramSvg, yandexMapsSvg,
        themeSwapper,
        themeTranslator,
        hexSwapper
    ] =
    [
        id('theme-btn'), selector('html'),
        selector('#profile-svg #color'),
        selector('#vk-svg #color'),
        selector('#telegram-svg #color'),
        selector('#yandex-maps-svg'),
        {
            'light': 'dark',
            'dark': 'light',
        },
        {
            'light': 'fff',
            'dark': '000',
        },
        {
            'fff': '000',
            '000': 'fff',
        }
    ];

event(document,'DOMContentLoaded', () => changeTheme(get('theme') === 'light' ? 'dark' : 'light'));
event(themeBtn,'click', () => changeTheme(get('theme')));

function changeTheme(theme) {
    theme = themeSwapper[theme]; // opposite theme

    set('theme', theme);
    html.setAttribute('theme', theme);

    themeBtn.style.transform = theme === 'light' ? '' : 'scaleX(-1)';

    theme = themeTranslator[theme]; // hex code of color


    themeBtn.querySelector('#color').style = 'fill:#' + hexSwapper[theme]; // opposite theme

    if (profileSvg !== null) { // is user login
        profileSvg.style = 'fill:#' + theme;
    }

    vkSvg.style = 'fill:#' + theme;
    telegramSvg.style = 'fill:#' + theme;
    yandexMapsSvg.style = 'fill:#' + theme;
}
