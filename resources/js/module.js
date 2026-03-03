const get = (item) => localStorage.getItem(item);
const set = (item, value) => localStorage.setItem(item, value);

const id = (id) => document.getElementById(id);
const selector = (selector) => document.querySelector(selector);
const selectors = (selector) => document.querySelectorAll(selector);

const event = (element, event, func) => element.addEventListener(event, func);

export { get, set, id, selector, selectors, event }
