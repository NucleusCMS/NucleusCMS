<!-- archive: page title and extra navigational links -->
<%if(skintype,archive)%>
<title><%blogsetting(name)%> &raquo; Archive</title>
<link rel="archives" title="Archives" href="<%archivelink%>" />
<link rel="top" title="Today" href="<%sitevar(url)%>" />
<link rel="up" href="<%todaylink%>" title="Today" />
<%endif%>

<!-- archivelist: page title and extra navigational links -->
<%if(skintype,archivelist)%>
<title><%blogsetting(name)%> &raquo; Archive List</title>
<link rel="archives" title="Archives" href="<%archivelink%>" />
<link rel="top" title="Today" href="<%sitevar(url)%>" />
<link rel="up" href="<%todaylink%>" title="Today" />
<%endif%>

<!-- error: page title and extra navigational links -->
<%if(skintype,error)%>
<title><%sitevar(name)%> &raquo; Error!</title>
<link rel="top" title="Today" href="<%todaylink%>" />
<link rel="up" href="<%todaylink%>" title="Today" />
<%endif%>

<!-- index: page title and extra navigational links -->
<%if(skintype,index)%>
<title><%blogsetting(name)%></title>
<link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />
<link rel="archives" title="Archives" href="<%archivelink%>" />
<link rel="top" title="Today" href="<%todaylink%>" />
<%endif%>

<!-- item: page title and extra navigational links -->
<%if(skintype,item)%>
<title><%blogsetting(name)%> &raquo; <%itemtitle(attribute)%></title>
<link rel="archives" title="Archives" href="<%archivelink%>" />
<link rel="top" title="Today" href="<%sitevar(url)%>" />
<link rel="next" href="<%nextlink%>" title="Next Item" />
<link rel="prev" href="<%prevlink%>" title="Previous Item" />
<link rel="up" href="<%todaylink%>" title="Today" />
<%endif%>

<!-- member: page title and extra navigational links -->
<%if(skintype,member)%>
<title><%blogsetting(name)%> &raquo; Member Details</title>
<link rel="top" title="Today" href="<%todaylink%>" />
<link rel="up" href="<%todaylink%>" title="Today" />
<%endif%>

<!-- search: page title and extra navigational links -->
<%if(skintype,search)%>
<title><%blogsetting(name)%> &raquo; Search</title>
<link rel="archives" title="Archives" href="<%archivelink%>" />
<link rel="top" title="Today" href="<%sitevar(url)%>" />
<link rel="up" href="<%todaylink%>" title="Today" />
<%endif%>
</head>