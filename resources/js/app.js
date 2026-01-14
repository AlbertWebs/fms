import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Initialize Alpine store for sidebar
document.addEventListener('alpine:init', () => {
    Alpine.store('sidebar', {
        open: window.innerWidth >= 1024 ? true : false
    });
});

Alpine.start();
