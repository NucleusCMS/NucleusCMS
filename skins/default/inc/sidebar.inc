<!-- page menu -->
<div class="sidebar">
<dl class="sidebardl">
<dt>ナビゲーション</dt>

<%if(skintype,archive)%>
<!-- archive: navigation -->
<dd><a href="<%prevlink%>" title="前の月">前の<%archivetype%></a></dd>
<dd><a href="<%nextlink%>" title="次の月">次の<%archivetype%></a></dd>
<dd><a href="<%todaylink%>" title="今日の登録">最新の投稿</a></dd>
<dd><a href="<%archivelink%>" title="過去の投稿">過去の投稿</a></dd>

<%elseif(skintype,archivelist)%>
<!-- archivelist: navigation -->
<dd><a href="<%todaylink%>" title="最新の投稿">最新の投稿</a></dd>
<dd><a href="<%archivelink%>" title="過去の投稿">過去の投稿</a></dd>

<%elseif(skintype,error)%>
<!-- error: navigation -->
<dd><a href="<%todaylink%>" title="最新の投稿">最新の投稿</a></dd>

<%elseif(skintype,index)%>
<!-- index: navigation -->
<dd><a href="<%todaylink%>" title="最新の投稿">最新の投稿</a></dd>
<dd><a href="<%archivelink%>" title="過去の投稿">過去の投稿</a></dd>

<!-- item: navigation -->
<%elseif(skintype,item)%>
<%if(previtem)%><dd><a href="<%prevlink%>" title="前の投稿">前の投稿</a></dd><%endif%>
<%if(nextitem)%><dd><a href="<%nextlink%>" title="次の投稿">次の投稿</a></dd><%endif%>
<dd><a href="<%todaylink%>" title="最新順の投稿一覧">最新順の投稿一覧</a></dd>
<dd><a href="<%archivelink%>" title="過去の投稿">過去の投稿一覧</a></dd>

<!-- member: navigation -->
<%elseif(skintype,member)%>
<dd><a href="<%todaylink%>" title="最新の投稿">最新の投稿</a></dd>

<!-- search: navigation -->
<%elseif(skintype,search)%>
<dd><a href="<%todaylink%>" title="最新の投稿">最新の投稿</a></dd>
<dd><a href="<%archivelink%>" title="過去の投稿">過去の投稿</a></dd>
<%endif%>

<%if(loggedin)%>
<!-- admin link, only visible if logged in -->
<%if(skintype,index)%>
<dd><a href="javascript:showedit();">クイック投稿</a></dd>
<%endif%>
<dd><a href="<%addlink%>" onclick="<%addpopupcode%>" title="ブログに記事を投稿(新規投稿ウィンドウが開きます)">新規投稿(ポップアップ)</a></dd>
<dd><a href="<%adminurl%>" title="管理画面">管理画面</a></dd>
<%endif%>
</dl>
</div>

<%if(skintype,error)%>
<%elseifnot(skintype,member)%>
<!-- category list, not on error or member page -->
<div class="sidebar">
<dl class="sidebardl">
<dt>カテゴリ</dt>
<%categorylist(default/categorylist)%>
</dl>
</div>
<%endif%>

<!-- bloglist-->
<div class="sidebar">
<dl class="sidebardl">
<dt>Blogs</dt>
<%bloglist(default/bloglist)%>
</dl>
</div>

<!-- search form -->
<div class="sidebar">
<dl class="sidebardl">
<dt>検索</dt>
<dd><%searchform%></dd>
</dl>
</div>

<!-- login form -->
<div class="sidebar">
<dl class="sidebardl">
<dt>ログイン</dt>
<dd><%loginform%></dd>
</dl>
</div>

<!-- links -->
<div class="sidebar">
<dl class="sidebardl">
<dt>リンク</dt>
<%parsedinclude(inc/linklist.inc)%>
</dl>
</div>

<!-- Powered by -->
<div class="sidebar">
<div class="sidebardl centerize">
<%nucleusbutton(images/nucleus.gif,85,31)%>
</div>
</div>

<!-- benchmark -->
<div class="sidebar">
<dl class="sidebardl">
<dt>ページ生成時間</dt>
<dd><%phpinclude(inc/show_benchmark.inc)%></dd>
</dl>
</div>
