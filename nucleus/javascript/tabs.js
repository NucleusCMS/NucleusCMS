/**
 * Generic Tab UI Handler for Nucleus CMS Admin Area
 * 
 * This script provides a reusable tab switching functionality.
 * It can be used on any page with the following HTML structure:
 * 
 * <div class="[any-class]-tabs">
 *   <ul class="tab-nav">
 *     <li class="active"><a href="#tab-1">Tab 1</a></li>
 *     <li><a href="#tab-2">Tab 2</a></li>
 *   </ul>
 *   <div class="tab-content">
 *     <div id="tab-1" class="tab-pane active">Content 1</div>
 *     <div id="tab-2" class="tab-pane">Content 2</div>
 *   </div>
 * </div>
 */

(function() {
    'use strict';
    
    // Initialize tabs when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAllTabs);
    } else {
        initAllTabs();
    }
    
    function initAllTabs() {
        // Find all tab navigation elements on the page
        const tabNavs = document.querySelectorAll('.tab-nav');
        
        tabNavs.forEach(function(tabNav) {
            initTabGroup(tabNav);
        });
    }
    
    function initTabGroup(tabNav) {
        // Get active tab from URL hash or default to first tab
        const hash = window.location.hash;
        
        // Add click event listeners to all tab links in this group
        const tabLinks = tabNav.querySelectorAll('a');
        tabLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetTab = this.getAttribute('href');
                switchTab(tabNav, targetTab);
                window.location.hash = targetTab;
            });
        });
        
        // Activate initial tab
        if (hash && tabNav.querySelector('a[href="' + hash + '"]')) {
            switchTab(tabNav, hash);
        } else {
            // Activate the first tab if no hash or hash doesn't match
            const firstTab = tabLinks[0] ? tabLinks[0].getAttribute('href') : null;
            if (firstTab) {
                switchTab(tabNav, firstTab);
            }
        }
        
        // Handle hash changes (browser back/forward)
        window.addEventListener('hashchange', function() {
            const newHash = window.location.hash;
            if (newHash && tabNav.querySelector('a[href="' + newHash + '"]')) {
                switchTab(tabNav, newHash);
            }
        });
    }
    
    function switchTab(tabNav, tabId) {
        // Find the parent container
        const container = tabNav.closest('[class*="-tabs"]');
        if (!container) return;
        
        // Remove active class from all tabs and panes in this container
        const navItems = container.querySelectorAll('.tab-nav li');
        const tabPanes = container.querySelectorAll('.tab-pane');
        
        navItems.forEach(function(item) {
            item.classList.remove('active');
        });
        
        tabPanes.forEach(function(pane) {
            pane.classList.remove('active');
        });
        
        // Add active class to selected tab and pane
        const targetLink = container.querySelector('.tab-nav a[href="' + tabId + '"]');
        const targetPane = container.querySelector(tabId);
        
        if (targetLink && targetPane) {
            targetLink.parentElement.classList.add('active');
            targetPane.classList.add('active');
        }
    }
})();
