/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  *  
  * Some JavaScript code for the admin area
  */

function help(url) {
	popup = window.open(url,'helpwindow','status=no,toolbar=yes,scrollbars=yes,resizable=yes,width=500,height=500,top=0,left=0');
	if (popup.focus) popup.focus();
	if (popup.GetAttention) popup.GetAttention();
	return false;
}				

var oldCellColor = "#000";
function focusRow(row) {
	var cells = row.cells;
	if (!cells) return;
	oldCellColor = cells[0].style.backgroundColor;
	for (var i=0;i<cells.length;i++) {
		cells[i].style.backgroundColor='whitesmoke';
	}
}
function blurRow(row) {
	var cells = row.cells;
	if (!cells) return;
	for (var i=0;i<cells.length;i++) {
		cells[i].style.backgroundColor=oldCellColor;
	}
}
function batchSelectAll(what) {
        var i = 0;
        var el;
        while (el = document.getElementById('batch' + i)) {
                el.checked = what ? true : false;
                i++;
        }
        batchUpdateToggleCheckbox();
        return false;
}
function batchInvertSelection() {
        var i = 0;
        var el;
        while (el = document.getElementById('batch' + i)) {
                el.checked = !el.checked;
                i++;
        }
        batchUpdateToggleCheckbox();
        return false;
}
function batchToggleSelect(toggle) {
        if (!toggle) return false;

        // 現在の状態を確認して反転
        var allChecked = batchIsAllChecked();
        batchSelectAll(allChecked ? 0 : 1);
        toggle.checked = !allChecked;

        return false;
}
function batchIsAllChecked() {
        var i = 0;
        var el;
        var hasItems = false;
        while (el = document.getElementById('batch' + i)) {
                hasItems = true;
                if (!el.checked) {
                        return false;
                }
                i++;
        }
        return hasItems;
}
function batchUpdateToggleCheckbox() {
        var toggleCheckbox = document.getElementById('batch-toggle-all');
        if (toggleCheckbox) {
                var allChecked = batchIsAllChecked();
                toggleCheckbox.checked = allChecked;
        }
}
function batchOnItemCheckboxChange() {
        batchUpdateToggleCheckbox();
}

// ページ読み込み後に初期状態を設定
if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', batchUpdateToggleCheckbox);
} else {
        batchUpdateToggleCheckbox();
}
// Smooth compact header on scroll
(function() {
    var scrollStart = 0;      // スクロール開始位置
    var scrollEnd = 100;      // 完全にコンパクトになる位置
    var header = null;
    var ticking = false;
    var isCompact = false;    // コンパクトモードかどうか

    // 初期パディング値
    var paddingMax = 14;
    var paddingMin = 6;
    var fontSizeMax = 0.95;
    var fontSizeMin = 0.85;
    var loginPaddingMax = 8;
    var loginPaddingMin = 4;

    function updateHeader() {
        if (!header) {
            header = document.querySelector('.app-header');
        }
        if (header) {
            var scrollY = window.scrollY;
            // 0〜1の進捗度を計算
            var progress = Math.min(1, Math.max(0, (scrollY - scrollStart) / (scrollEnd - scrollStart)));
            
            // CSS変数で進捗度を設定
            header.style.setProperty('--header-progress', progress);
            
            // パディングを段階的に変更
            var padding = paddingMax - (paddingMax - paddingMin) * progress;
            header.style.paddingTop = padding + 'px';
            header.style.paddingBottom = padding + 'px';
            
            // loginname要素のスタイルを段階的に変更
            var loginname = header.querySelector('.loginname');
            if (loginname) {
                var fontSize = fontSizeMax - (fontSizeMax - fontSizeMin) * progress;
                var loginPadding = loginPaddingMax - (loginPaddingMax - loginPaddingMin) * progress;
                loginname.style.fontSize = fontSize + 'rem';
                loginname.style.paddingTop = loginPadding + 'px';
                loginname.style.paddingBottom = loginPadding + 'px';
                
                // コンパクトモードの切り替え（50%を閾値として）
                var shouldBeCompact = progress > 0.5;
                if (shouldBeCompact !== isCompact) {
                    isCompact = shouldBeCompact;
                    var userRow = loginname.querySelector('.loginname-user');
                    var linksRow = loginname.querySelector('.loginname-links');
                    if (userRow && linksRow) {
                        if (isCompact) {
                            userRow.style.display = 'inline';
                            linksRow.style.display = 'inline';
                        } else {
                            userRow.style.display = 'block';
                            linksRow.style.display = 'block';
                        }
                    }
                }
            }
        }
        ticking = false;
    }

    function onScroll() {
        if (!ticking) {
            window.requestAnimationFrame(updateHeader);
            ticking = true;
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('scroll', onScroll, { passive: true });
            updateHeader(); // 初期状態を設定
        });
    } else {
        window.addEventListener('scroll', onScroll, { passive: true });
        updateHeader(); // 初期状態を設定
    }
})();

function selectCanLogin(flag) {
        if (flag) {
                window.document.memberedit.canlogin[0].checked=true;

                // don't disable canlogin[0], otherwise the value won't be passed.
//		window.document.memberedit.canlogin[0].disabled=true;
		window.document.memberedit.canlogin[1].disabled=true;
	} else {
		window.document.memberedit.canlogin[0].disabled=false;
		window.document.memberedit.canlogin[1].disabled=false;
	}
}
