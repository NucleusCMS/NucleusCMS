<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<!-- meta information for search engines -->
<meta name="generator" content="<%version%>" />
<meta name="name" content="<%blogsetting(name)%>" />
<meta name="description" content="<%blogsetting(desc)%>" />

<!-- stylesheet (site colors and layout definitions) -->
<link rel="stylesheet" type="text/css" href="<%skinfile(default.css)%>" />

<!-- popup tooltips on links -->
<link rel="stylesheet" type="text/css" href="<%skinfile(nicetitle.css)%>" />
<script type="text/javascript" src="<%skinfile(nicetitle.js)%>"></script>

<!-- favorite icon -->
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="icon" href="/favicon.ico" />

<!-- prevent caching (can be removed) -->
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
<meta http-equiv="Expires" content="-1" />

<!-- RSS 2.0 feed -->
<link rel="alternate" type="application/rss+xml" title="RSS" href="xml-rss2.php" />

<!-- RSD support -->
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="rsd.php" />

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
<title><%blogsetting(name)%> &raquo; <%itemtitle%></title>
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