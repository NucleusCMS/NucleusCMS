<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta name="generator" content="<%version%>" />
<meta name="name" content="<%blogsetting(name)%>" />
<meta name="description" content="<%blogsetting(desc)%>" />

<!-- stylesheets -->
<link rel="stylesheet" type="text/css" href="<%skinfile(default.css)%>" />

<link rel="stylesheet" type="text/css" href="<%skinfile(nicetitle.css)%>" />
<script type="text/javascript" src="<%sitevar(url)%>nicetitle.js">"</script>

<link rel="shortcut icon" href="/favicon.ico" />
<link rel="icon" href="/favicon.ico" />

<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
<meta http-equiv="Expires" content="-1" />

<link rel="alternate" type="application/rss+xml" title="RSS" href="xml-rss2.php" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="rsd.php" />

<%if(skintype,archive)%>
<title><%blogsetting(name)%> &raquo; Archive</title>
<link rel="archives" title="Archives" href="<%archivelink%>" />
<link rel="top" title="Today" href="<%sitevar(url)%>" />
<link rel="up" href="<%todaylink%>" title="Today" />
<%endif%>

<%if(skintype,archivelist)%>
<title><%blogsetting(name)%> &raquo; Archive List</title>
<link rel="archives" title="Archives" href="<%archivelink%>" />
<link rel="top" title="Today" href="<%sitevar(url)%>" />
<link rel="up" href="<%todaylink%>" title="Today" />
<%endif%>

<%if(skintype,error)%>
<title><%sitevar(name)%> &raquo; Error!</title>
<link rel="top" title="Today" href="<%todaylink%>" />
<link rel="up" href="<%todaylink%>" title="Today" />
<%endif%>

<%if(skintype,index)%>
<title><%blogsetting(name)%></title>
<link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />
<link rel="archives" title="Archives" href="<%archivelink%>" />
<link rel="top" title="Today" href="<%todaylink%>" />
<%endif%>

<%if(skintype,item)%>
<title><%blogsetting(name)%> &raquo; <%itemtitle%></title>
<link rel="archives" title="Archives" href="<%archivelink%>" />
<link rel="top" title="Today" href="<%sitevar(url)%>" />
<link rel="next" href="<%nextlink%>" title="Next Item" />
<link rel="prev" href="<%prevlink%>" title="Previous Item" />
<link rel="up" href="<%todaylink%>" title="Today" />
<%endif%>

<%if(skintype,member)%>
<title><%blogsetting(name)%> &raquo; Member Details</title>
<link rel="top" title="Today" href="<%todaylink%>" />
<link rel="up" href="<%todaylink%>" title="Today" />
<%endif%>

<%if(skintype,search)%>
<title><%blogsetting(name)%> &raquo; Search</title>
<link rel="archives" title="Archives" href="<%archivelink%>" />
<link rel="top" title="Today" href="<%sitevar(url)%>" />
<link rel="up" href="<%todaylink%>" title="Today" />
<%endif%>
</head>
