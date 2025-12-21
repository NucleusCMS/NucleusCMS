/**
 * Generic Tab UI Handler for Nucleus CMS Admin Area
 * 
 * Modern tab switching implementation without URL hash updates or scrolling.
 * 
 * Features:
 * - Pure CSS class-based tab switching
 * - No URL hash changes (prevents unwanted scrolling)
 * - No browser history pollution
 * - Automatic initialization on page load
 * - Manual initialization support via window.initTabs()
 * 
 * HTML structure required:
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
 * 
 * Usage:
 * 1. Include this script: <script src="javascript/tabs.js"></script>
 * 2. Tabs are automatically initialized when DOM is ready
 * 3. First tab is automatically activated
 * 4. Manual init: window.initTabs('container-id') if needed
 * 
 * CSS classes:
 * - .tab-nav li.active: Active tab navigation item
 * - .tab-pane.active: Active tab content pane
 */

(function() {
    'use strict';
    
    // Initialize tabs when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAllTabs);
    } else {
        initAllTabs();
    }
    
    /**
     * Find and initialize all tab groups on the page
     */
    function initAllTabs() {
        // Find all tab navigation elements on the page
        const tabNavs = document.querySelectorAll('.tab-nav');
        
        tabNavs.forEach(function(tabNav) {
            initTabGroup(tabNav);
        });
    }
    
    /**
     * Initialize a single tab group
     * @param {HTMLElement} tabNav - The .tab-nav element
     */
    function initTabGroup(tabNav) {
        // Add click event listeners to all tab links in this group
        const tabLinks = tabNav.querySelectorAll('a');
        
        tabLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                // Prevent default behavior (no scrolling to anchor, no hash change)
                e.preventDefault();
                e.stopPropagation();
                
                // Get the target tab ID from href
                const href = this.getAttribute('href');
                if (!href || !href.startsWith('#')) return;
                
                const targetId = href.substring(1);
                switchTab(tabNav, targetId);
            });
        });
        
        // Activate the first tab by default
        if (tabLinks.length > 0) {
            const firstHref = tabLinks[0].getAttribute('href');
            if (firstHref && firstHref.startsWith('#')) {
                const firstTargetId = firstHref.substring(1);
                switchTab(tabNav, firstTargetId);
            }
        }
    }
    
    /**
     * Switch to a specific tab
     * @param {HTMLElement} tabNav - The .tab-nav element
     * @param {string} targetId - ID of the target tab pane (without #)
     */
    function switchTab(tabNav, targetId) {
        // Find the parent container
        const container = tabNav.closest('[class*="-tabs"]');
        if (!container) return;
        
        // Find the target pane
        const targetPane = document.getElementById(targetId);
        if (!targetPane) return;
        
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
        const targetLink = container.querySelector('.tab-nav a[href="#' + targetId + '"]');
        
        if (targetLink) {
            targetLink.parentElement.classList.add('active');
        }
        
        targetPane.classList.add('active');
    }
    
    /**
     * Manually initialize tabs for a specific container
     * @param {string} containerId - ID of the container element
     */
    window.initTabs = function(containerId) {
        const container = document.getElementById(containerId);
        if (!container) return;
        
        const tabNav = container.querySelector('.tab-nav');
        if (tabNav) {
            initTabGroup(tabNav);
        }
    };
})();
