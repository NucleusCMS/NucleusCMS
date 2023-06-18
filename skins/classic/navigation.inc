<!-- archive: page title and extra navigational links -->
<%if(skintype,archive)%>
<title><%blogsetting(name)%> &raquo; <%_(Archive)%></title>
<link rel="archives" title="<%_(Archives)%>" href="<%archivelink%>" />
<link rel="top" title="<%_(Today)%>" href="<%sitevar(url)%>" />
<link rel="up" href="<%todaylink%>" title="<%_(Today)%>" />
<%endif%>

<!-- archivelist: page title and extra navigational links -->
<%if(skintype,archivelist)%>
<title><%blogsetting(name)%> &raquo; <%_(Archive List)%></title>
<link rel="archives" title="<%_(Archives)%>" href="<%archivelink%>" />
<link rel="top" title="<%_(Today)%>" href="<%sitevar(url)%>" />
<link rel="up" href="<%todaylink%>" title="<%_(Today)%>" />
<%endif%>

<!-- error: page title and extra navigational links -->
<%if(skintype,error)%>
<title><%sitevar(name)%> &raquo; <%_(Error!)%></title>
<link rel="top" title="<%_(Today)%>" href="<%todaylink%>" />
<link rel="up" href="<%todaylink%>" title="<%_(Today)%>" />
<%endif%>

<!-- index: page title and extra navigational links -->
<%if(skintype,index)%>
<title><%blogsetting(name)%></title>
<link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />
<link rel="archives" title="<%_(Archives)%>" href="<%archivelink%>" />
<link rel="top" title="<%_(Today)%>" href="<%todaylink%>" />
<%endif%>

<!-- item: page title and extra navigational links -->
<%if(skintype,item)%>
<title><%blogsetting(name)%> &raquo; <%itemtitle(attribute)%></title>
<link rel="archives" title="<%_(Archives)%>" href="<%archivelink%>" />
<link rel="top" title="<%_(Today)%>" href="<%sitevar(url)%>" />
<link rel="next" href="<%nextlink%>" title="<%_(Next Item)%>" />
<link rel="prev" href="<%prevlink%>" title="<%_(Previous Item)%>" />
<link rel="up" href="<%todaylink%>" title="<%_(Today)%>" />
<%endif%>

<!-- member: page title and extra navigational links -->
<%if(skintype,member)%>
<title><%blogsetting(name)%> &raquo; <%_(Member Details)%></title>
<link rel="top" title="<%_(Today)%>" href="<%todaylink%>" />
<link rel="up" href="<%todaylink%>" title="<%_(Today)%>" />
<%endif%>

<!-- search: page title and extra navigational links -->
<%if(skintype,search)%>
<title><%blogsetting(name)%> &raquo; <%_(Search)%></title>
<link rel="archives" title="<%_(Archives)%>" href="<%archivelink%>" />
<link rel="top" title="<%_(Today)%>" href="<%sitevar(url)%>" />
<link rel="up" href="<%todaylink%>" title="<%_(Today)%>" />
<%endif%>
</head>