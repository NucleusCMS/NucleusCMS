<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<!-- meta information for search engines -->
<meta name="generator" content="<%version%>" />
<meta name="name" content="<%if(skintype,error)%><%sitevar(name)%><%else%><%blogsetting(name)%><%endif%>" />
<meta name="description" content="<%if(skintype,error)%><%sitevar(name)%><%else%><%blogsetting(desc)%><%endif%>" />

<!-- prevent caching (can be removed) -->
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
<meta http-equiv="Expires" content="-1" />

<!-- site stylesheet (site colors and layout definitions) -->
<link rel="stylesheet" type="text/css" href="<%skinfile(default_right.css)%>" />

<!-- tooltips & stylesheet (activated by title="" on links) -->
<link rel="stylesheet" type="text/css" href="<%skinfile(nicetitle.css)%>" />
<script type="text/javascript" src="<%skinfile(nicetitle.js)%>"></script>

<!-- RSS 2.0 feed -->
<link rel="alternate" type="application/rss+xml" title="RSS" href="xml-rss2.php" />

<!-- RSD support -->
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="rsd.php" />

<!-- favorite icon -->
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="icon" href="/favicon.ico" />

<!-- navigation & page titles -->
<%parsedinclude(navigation.inc)%>
