import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import.meta.glob([
    '../images/**',
]);

import './lib/svg-sprite.js';
import './page/dashboard/index';
import './page/task/index';
