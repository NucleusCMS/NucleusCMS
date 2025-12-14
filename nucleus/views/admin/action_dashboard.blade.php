{{-- Dashboard Template --}}

@php
    $blogCount = count($blogs);
    $showQuickCreateButtons = ($blogCount <= 3);
    // Get the most recently updated blogs (top 3) for quick actions when many blogs exist
    $recentBlogsForQuickAction = array_slice($blogSummary, 0, 3);
@endphp

@if ($msg)
    <p class="message">{{ $msg }}</p>
@endif

{{-- Quick Actions --}}
<section class="dashboard-section dashboard-quick-actions">
    <h2><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg> {{ _DASHBOARD_QUICK_ACTIONS }}</h2>
    <div class="quick-actions-grid">
        @if ($showQuickCreateButtons)
            {{-- Few blogs: show create button for each --}}
            @foreach ($blogs as $blog)
                <a href="index.php?action=createitem&amp;blogid={{ $blog['bnumber'] }}" class="quick-action-btn quick-action-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    <span>{{ _DASHBOARD_NEW_ITEM }} ({{ $blog['bname'] }})</span>
                </a>
            @endforeach
        @elseif ($blogCount > 0)
            {{-- Many blogs: show dropdown selector --}}
            <div class="quick-action-dropdown">
                <button type="button" class="quick-action-btn quick-action-primary" id="quickCreateBtn" onclick="toggleQuickCreateDropdown()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    <span>{{ _DASHBOARD_NEW_ITEM }}</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div class="quick-action-dropdown-menu" id="quickCreateMenu">
                    <div class="dropdown-section-label">{{ _DASHBOARD_RECENT_BLOGS }}</div>
                    @foreach ($recentBlogsForQuickAction as $blog)
                        <a href="index.php?action=createitem&amp;blogid={{ $blog['bnumber'] }}">{{ $blog['bname'] }}</a>
                    @endforeach
                    <div class="dropdown-divider"></div>
                    <a href="index.php?action=bloglist" class="dropdown-all-link">{{ _DASHBOARD_ALL_BLOGS }} ({{ $blogCount }}) &raquo;</a>
                </div>
            </div>
        @endif
        <a href="index.php?action=bloglist" class="quick-action-btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
            <span>{{ _DASHBOARD_BLOG_LIST }} ({{ $blogCount }})</span>
        </a>
        <a href="index.php?action=browseownitems" class="quick-action-btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            <span>{{ _OVERVIEW_BROWSEITEMS }}</span>
        </a>
        <a href="index.php?action=browseowncomments" class="quick-action-btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            <span>{{ _OVERVIEW_BROWSECOMM }}</span>
        </a>
    </div>
</section>

{{-- Statistics Summary Cards --}}
<section class="dashboard-section">
    <h2><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg> {{ _DASHBOARD_STATISTICS }}</h2>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon stat-icon-items">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <div class="stat-content">
                <div class="stat-number">{{ $stats['total_items'] }}</div>
                <div class="stat-label">{{ _DASHBOARD_TOTAL_ITEMS }}</div>
                <div class="stat-detail">
                    <span class="stat-published">{{ _DASHBOARD_PUBLISHED }}: {{ $stats['published_items'] }}</span>
                    <span class="stat-draft">{{ _DASHBOARD_DRAFTS }}: {{ $stats['draft_items'] }}</span>
                </div>
            </div>
        </div>

        <div class="stat-card{{ $stats['pending_comments'] > 0 ? ' stat-card-highlight' : '' }}">
            <div class="stat-icon stat-icon-comments">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </div>
            <div class="stat-content">
                <div class="stat-number">{{ $stats['total_comments'] }}</div>
                <div class="stat-label">{{ _DASHBOARD_TOTAL_COMMENTS }}</div>
                @if ($stats['pending_comments'] > 0)
                    <div class="stat-detail stat-pending">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        {{ _DASHBOARD_PENDING }}: {{ $stats['pending_comments'] }}
                    </div>
                @endif
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-categories">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
            </div>
            <div class="stat-content">
                <div class="stat-number">{{ $stats['total_categories'] }}</div>
                <div class="stat-label">{{ _DASHBOARD_TOTAL_CATEGORIES }}</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-blogs">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
            </div>
            <div class="stat-content">
                <div class="stat-number">{{ $stats['total_blogs'] }}</div>
                <div class="stat-label">{{ _DASHBOARD_TOTAL_BLOGS }}</div>
            </div>
        </div>

        @if ($isAdmin)
        <div class="stat-card">
            <div class="stat-icon stat-icon-members">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div class="stat-content">
                <div class="stat-number">{{ $stats['total_members'] }}</div>
                <div class="stat-label">{{ _DASHBOARD_TOTAL_MEMBERS }}</div>
            </div>
        </div>
        @endif
    </div>
</section>

{{-- Recent Activity --}}
<div class="dashboard-columns">
    {{-- Recent Items --}}
    <section class="dashboard-section dashboard-column">
        <h2><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg> {{ _DASHBOARD_RECENT_ITEMS }}</h2>
        @if (count($recentItems) > 0)
            <div class="activity-list">
                @foreach ($recentItems as $item)
                    <div class="activity-item">
                        <div class="activity-header">
                            <a href="index.php?action=itemedit&amp;itemid={{ $item['inumber'] }}" class="activity-title">{{ $item['ititle'] }}</a>
                            @if ($item['idraft'] == 1)
                                <span class="badge badge-draft">{{ _ADD_DRAFT }}</span>
                            @endif
                        </div>
                        <div class="activity-meta">
                            <span class="activity-blog">{{ $item['bname'] }}</span>
                            <span class="activity-date">{{ $item['itime'] }}</span>
                            @if ($item['comment_count'] > 0)
                                <span class="activity-comments">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                    {{ $item['comment_count'] }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="no-data">{{ _DASHBOARD_NO_RECENT_ITEMS }}</p>
        @endif
    </section>

    {{-- Recent Comments --}}
    <section class="dashboard-section dashboard-column">
        <h2><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg> {{ _DASHBOARD_RECENT_COMMENTS }}</h2>
        @if (count($recentComments) > 0)
            <div class="activity-list">
                @foreach ($recentComments as $comment)
                    <div class="activity-item{{ empty($comment['cmemberid']) ? ' activity-item-pending' : '' }}">
                        <div class="activity-header">
                            <span class="activity-author">{{ $comment['cuser'] }}</span>
                            @if (empty($comment['cmemberid']))
                                <span class="badge badge-pending">{{ _DASHBOARD_GUEST }}</span>
                            @endif
                            <span class="activity-date">{{ $comment['ctime'] }}</span>
                            <a href="index.php?action=commentedit&amp;commentid={{ $comment['cnumber'] }}" class="activity-edit-btn" title="{{ _LISTS_EDIT }}">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </a>
                        </div>
                        <div class="activity-body">{{ mb_substr(strip_tags($comment['cbody']), 0, 65) }}{{ mb_strlen(strip_tags($comment['cbody'])) > 65 ? '...' : '' }}</div>
                        <div class="activity-meta">
                            <a href="index.php?action=itemedit&amp;itemid={{ $comment['citem'] }}" class="activity-item-link">{{ $comment['ititle'] }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="no-data">{{ _DASHBOARD_NO_RECENT_COMMENTS }}</p>
        @endif
    </section>
</div>

{{-- Blog Summary (collapsible for many blogs) --}}
@if ($blogCount > 0)
<section class="dashboard-section">
    <h2>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg> 
        {{ _DASHBOARD_BLOG_SUMMARY }}
        <span class="section-count">({{ $blogCount }})</span>
    </h2>
    
    @php
        $initialShowCount = 6;
        $hasMore = $blogCount > $initialShowCount;
    @endphp
    
    <div class="blog-summary-grid" id="blogSummaryGrid">
        @foreach ($blogSummary as $index => $blog)
            <div class="blog-summary-card{{ $index >= $initialShowCount ? ' blog-summary-hidden' : '' }}" data-blog-index="{{ $index }}">
                <div class="blog-summary-header">
                    <a href="{{ $blog['burl'] }}" class="blog-summary-name" target="_blank">{{ $blog['bname'] }}</a>
                </div>
                <div class="blog-summary-stats">
                    <div class="blog-summary-stat">
                        <span class="blog-stat-value">{{ $blog['item_count'] }}</span>
                        <span class="blog-stat-label">{{ _DASHBOARD_ITEMS }}</span>
                        <span class="blog-stat-detail">({{ $blog['published_count'] }}/{{ $blog['draft_count'] }})</span>
                    </div>
                    <div class="blog-summary-stat">
                        <span class="blog-stat-value">{{ $blog['comment_count'] }}</span>
                        <span class="blog-stat-label">{{ _DASHBOARD_COMMENTS }}</span>
                    </div>
                    <div class="blog-summary-stat">
                        <span class="blog-stat-value">{{ $blog['category_count'] }}</span>
                        <span class="blog-stat-label">{{ _DASHBOARD_CATEGORIES }}</span>
                    </div>
                </div>
                @if ($blog['last_update'])
                    <div class="blog-summary-footer">
                        {{ _DASHBOARD_LAST_UPDATE }}: {{ $blog['last_update'] }}
                    </div>
                @else
                    <div class="blog-summary-footer blog-summary-no-items">
                        {{ _DASHBOARD_NO_ITEMS_YET }}
                    </div>
                @endif
                <div class="blog-summary-actions">
                    <a href="index.php?action=createitem&amp;blogid={{ $blog['bnumber'] }}">{{ _BLOGLIST_ADD }}</a>
                    <a href="index.php?action=itemlist&amp;blogid={{ $blog['bnumber'] }}">{{ _BLOGLIST_EDIT }}</a>
                    <a href="index.php?action=blogcommentlist&amp;blogid={{ $blog['bnumber'] }}">{{ _BLOGLIST_COMMENTS }}</a>
                    @if ($blog['tadmin'])
                        <a href="index.php?action=blogsettings&amp;blogid={{ $blog['bnumber'] }}">{{ _BLOGLIST_SETTINGS }}</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    
    @if ($hasMore)
        <div class="blog-summary-more">
            <button type="button" class="btn-show-more" id="showMoreBlogs" onclick="toggleMoreBlogs()">
                <span class="show-more-text">{{ _DASHBOARD_SHOW_MORE }} (+{{ $blogCount - $initialShowCount }})</span>
                <span class="show-less-text" style="display:none;">{{ _DASHBOARD_SHOW_LESS }}</span>
                <svg class="icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
        </div>
    @endif
</section>
@endif

{{-- Action Log (Admin Only) --}}
@if ($isAdmin && count($recentLogs) > 0)
<section class="dashboard-section dashboard-section-compact">
    <h2><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg> {{ _DASHBOARD_RECENT_LOGS }}</h2>
    <textarea class="log-textarea" readonly rows="8">@foreach ($recentLogs as $log){{ $log['timestamp'] }}  {{ $log['message'] }}
@endforeach</textarea>
    <p><a href="index.php?action=actionlog">{{ _OVERVIEW_VIEWLOG }} &raquo;</a></p>
</section>
@endif

{{-- User Settings --}}
<section class="dashboard-section dashboard-section-compact">
    <h2><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg> {{ _OVERVIEW_YRSETTINGS }}</h2>
    <ul class="settings-links">
        <li><a href="index.php?action=editmembersettings">{{ _OVERVIEW_EDITSETTINGS }}</a></li>
        <li><a href="index.php?action=memberpasswordchange">{{ _OVERVIEW_USER_PASSWORD }}</a></li>
    </ul>

    @if ($isAdmin)
        <h3>{{ _OVERVIEW_MANAGEMENT }}</h3>
        <ul class="settings-links">
            <li><a href="index.php?action=manage">{{ _OVERVIEW_MANAGE }}</a></li>
        </ul>
    @endif
</section>

<script>
function toggleQuickCreateDropdown() {
    var dropdown = document.querySelector('.quick-action-dropdown');
    dropdown.classList.toggle('open');
    
    // Close when clicking outside
    document.addEventListener('click', function closeMenu(e) {
        if (!e.target.closest('.quick-action-dropdown')) {
            dropdown.classList.remove('open');
            document.removeEventListener('click', closeMenu);
        }
    });
}

function toggleMoreBlogs() {
    var grid = document.getElementById('blogSummaryGrid');
    var btn = document.getElementById('showMoreBlogs');
    var isExpanded = btn.classList.contains('expanded');
    
    if (isExpanded) {
        // Collapse
        grid.querySelectorAll('.blog-summary-card').forEach(function(card) {
            if (parseInt(card.dataset.blogIndex) >= 6) {
                card.classList.add('blog-summary-hidden');
            }
        });
        btn.classList.remove('expanded');
        btn.querySelector('.show-more-text').style.display = '';
        btn.querySelector('.show-less-text').style.display = 'none';
    } else {
        // Expand
        grid.querySelectorAll('.blog-summary-hidden').forEach(function(card) {
            card.classList.remove('blog-summary-hidden');
        });
        btn.classList.add('expanded');
        btn.querySelector('.show-more-text').style.display = 'none';
        btn.querySelector('.show-less-text').style.display = '';
    }
}
</script>
