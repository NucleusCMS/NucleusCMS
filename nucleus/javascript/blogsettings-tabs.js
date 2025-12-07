/**
 * Blog Settings Tabs JavaScript
 * Handles tab switching and URL hash management
 */

(function() {
    'use strict';
    
    // Initialize tabs when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTabs);
    } else {
        initTabs();
    }
    
    function initTabs() {
        const tabNav = document.querySelector('.tab-nav');
        if (!tabNav) return;
        
        // Get active tab from URL hash or default to first tab
        const hash = window.location.hash || '#tab-blog';
        
        // Add click event listeners to all tab links
        const tabLinks = document.querySelectorAll('.tab-nav a');
        tabLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetTab = this.getAttribute('href');
                switchTab(targetTab);
                window.location.hash = targetTab;
            });
        });
        
        // Activate initial tab
        switchTab(hash);
        
        // Handle hash changes (browser back/forward)
        window.addEventListener('hashchange', function() {
            const newHash = window.location.hash || '#tab-blog';
            switchTab(newHash);
        });
    }
    
    function switchTab(tabId) {
        // Remove active class from all tabs and panes
        const navItems = document.querySelectorAll('.tab-nav li');
        const tabPanes = document.querySelectorAll('.tab-pane');
        
        navItems.forEach(function(item) {
            item.classList.remove('active');
        });
        
        tabPanes.forEach(function(pane) {
            pane.classList.remove('active');
        });
        
        // Add active class to selected tab and pane
        const targetLink = document.querySelector('.tab-nav a[href="' + tabId + '"]');
        const targetPane = document.querySelector(tabId);
        
        if (targetLink && targetPane) {
            targetLink.parentElement.classList.add('active');
            targetPane.classList.add('active');
        } else {
            // Fallback to first tab if target not found
            const firstLink = document.querySelector('.tab-nav a');
            const firstPane = document.querySelector('.tab-pane');
            if (firstLink && firstPane) {
                firstLink.parentElement.classList.add('active');
                firstPane.classList.add('active');
            }
        }
    }
})();
