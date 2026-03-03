import { id, selectors, event } from './module.js';

const technicIdField = id('technic_id');
const technics = [...selectors('.technic')];
const typeSelection = id('type-selection');

event(document, 'DOMContentLoaded', () => {
    if (technicIdField.value) {
        changeTechnic(id(technicIdField.value));
    }
});


technics.forEach(technic => event(technic, 'click', () => {
    typeSelection.value = '0';

    changeTechnic(technic);
}));

function changeTechnic(technic) {
    technicIdField.value = technic.id;

    technics.forEach(technic => technic.classList.replace('bgt4', 'bgt5'));
    technic.classList.replace('bgt5', 'bgt4');

    Array.from(typeSelection.children).forEach(option => {
        option.classList.toggle('hidden', option.getAttribute('technic') !== technic.id)
    });
}
