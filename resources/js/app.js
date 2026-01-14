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

// PWA Service Worker Registration
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then((registration) => {
                console.log('ServiceWorker registration successful');
            })
            .catch((error) => {
                console.log('ServiceWorker registration failed');
            });
    });
}

// PWA Install Prompt
let deferredPrompt;
let installPromptShown = false;

function hideInstallPrompt() {
    const installPrompt = document.getElementById('pwa-install-prompt');
    if (installPrompt) {
        installPrompt.style.display = 'none';
    }
}

window.addEventListener('beforeinstallprompt', (e) => {
    // Prevent Chrome 67 and earlier from automatically showing the prompt
    e.preventDefault();
    // Stash the event so it can be triggered later
    deferredPrompt = e;
    
    // Only show on desktop browsers
    if (window.innerWidth >= 768 && !installPromptShown) {
        // Show install prompt after a delay
        setTimeout(() => {
            const installPrompt = document.getElementById('pwa-install-prompt');
            if (installPrompt && deferredPrompt) {
                installPrompt.style.display = 'block';
                installPromptShown = true;
            }
        }, 5000);
    }
});

// Handle install button click
document.addEventListener('click', (e) => {
    if (e.target && (e.target.id === 'pwa-install-button' || e.target.closest('#pwa-install-button'))) {
        e.preventDefault();
        
        if (deferredPrompt) {
            // Show the install prompt
            deferredPrompt.prompt();
            
            // Wait for the user to respond to the prompt
            deferredPrompt.userChoice.then((choiceResult) => {
                if (choiceResult.outcome === 'accepted') {
                    console.log('User accepted the install prompt');
                } else {
                    console.log('User dismissed the install prompt');
                }
                deferredPrompt = null;
                hideInstallPrompt();
            });
        }
    }
    
        // Handle dismiss/close buttons
    if (e.target && (e.target.id === 'pwa-install-dismiss' || e.target.id === 'pwa-install-close' || e.target.closest('#pwa-install-dismiss') || e.target.closest('#pwa-install-close'))) {
        e.preventDefault();
        hideInstallPrompt();
    }
});

// Page Transition Animation
(function() {
    const pageContent = document.getElementById('page-content');
    
    // Handle link clicks for page transitions
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        
        // Only handle internal links (same origin)
        if (link && link.href && link.hostname === window.location.hostname && !link.hasAttribute('target')) {
            const href = link.getAttribute('href');
            
            // Skip if it's a hash link, mailto, tel, or javascript: link
            if (href && !href.startsWith('#') && !href.startsWith('javascript:') && !href.startsWith('mailto:') && !href.startsWith('tel:')) {
                // Check if link is not a form submission or special action
                if (!link.closest('form') && link.getAttribute('onclick') === null) {
                    // Add fade-out class
                    if (pageContent) {
                        pageContent.classList.add('page-fade-out');
                        pageContent.classList.remove('page-fade-in');
                    }
                }
            }
        }
    });
})();
