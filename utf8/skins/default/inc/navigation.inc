<!-- navigation & page titles -->
<%if(skintype,index)%>
<!-- index: page title and extra navigational links -->
<title><%blogsetting(name)%></title>
<link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />
<link rel="archives" title="Archives" href="<%archivelink%>" />
<link rel="top" title="Today" href="<%todaylink%>" />

<%elseif(skintype,item)%>
<!-- item: page title and extra navigational links -->
<title><%itemtitle(attribute)%> &raquo; <%blogsetting(name)%></title>
<link rel="archives" title="過去ログ" href="<%archivelink%>" />
<link rel="top" title="今日の投稿" href="<%sitevar(url)%>" />
<link rel="next" href="<%nextlink%>" title="次の記事" />
<link rel="prev" href="<%prevlink%>" title="前の記事" />
<link rel="up" href="<%todaylink%>" title="今日の投稿" />
<meta name="robots" content="all,noodp,noydir" />

<%elseif(skintype,archive)%>
<!-- archive: page title and extra navigational links -->
<title><%blogsetting(name)%> &raquo; 過去ログ</title>
<link rel="archives" title="Archives" href="<%archivelink%>" />
<link rel="top" title="Today" href="<%sitevar(url)%>" />
<link rel="up" href="<%todaylink%>" title="Today" />
<meta name="robots" content="all,noodp,noydir,NOINDEX,NOFOLLOW" />

<%elseif(skintype,archivelist)%>
<!-- archivelist: page title and extra navigational links -->
<title><%blogsetting(name)%> &raquo; 過去ログリスト</title>
<link rel="archives" title="Archives" href="<%archivelink%>" />
<link rel="top" title="Today" href="<%sitevar(url)%>" />
<link rel="up" href="<%todaylink%>" title="Today" />
<meta name="robots" content="all,noodp,noydir,NOINDEX,NOFOLLOW" />

<%elseif(skintype,error)%>
<!-- error: page title and extra navigational links -->
<title><%sitevar(name)%> &raquo; エラー!</title>
<link rel="top" title="Today" href="<%todaylink%>" />
<link rel="up" href="<%todaylink%>" title="Today" />
<meta name="robots" content="all,noodp,noydir,NOINDEX,NOFOLLOW" />

<%elseif(skintype,member)%>
<!-- member: page title and extra navigational links -->
<title><%blogsetting(name)%> &raquo; メンバー詳細</title>
<link rel="top" title="Today" href="<%todaylink%>" />
<link rel="up" href="<%todaylink%>" title="Today" />
<meta name="robots" content="all,noodp,noydir,NOINDEX,NOFOLLOW" />

<%elseif(skintype,search)%>
<!-- search: page title and extra navigational links -->
<title><%blogsetting(name)%> &raquo; 検索</title>
<link rel="archives" title="過去ログ" href="<%archivelink%>" />
<link rel="top" title="Today" href="<%sitevar(url)%>" />
<link rel="up" href="<%todaylink%>" title="Today" />
<%endif%>

<%if(loggedin)%>
<script type="text/javascript" src="<%adminurl%>javascript/edit.js"></script>
<%endif%>
