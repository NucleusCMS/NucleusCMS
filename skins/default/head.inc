<!DOCTYPE html>
<html>
<head>
<meta charset="<%charset%>" />

<!-- meta information for search engines -->
<meta name="name" content="<%if(skintype,error)%><%sitevar(name)%><%else%><%blogsetting(name)%><%endif%>" />
<meta name="description" content="<%if(skintype,error)%><%sitevar(name)%><%else%><%blogsetting(desc)%><%endif%>" />

<!-- site stylesheet (site colors and layout definitions) -->
<link rel="stylesheet" type="text/css" href="<%skinfile(default_right.css)%>" />

<!-- RSS 2.0 feed -->
<link rel="alternate" type="application/rss+xml" title="RSS" href="xml-rss2.php" />

<!-- ATOM support --> 
<link rel="alternate" type="application/atom+xml" title="ATOM" href="atom.php" /> 

<!-- navigation & page titles -->
<%parsedinclude(navigation.inc)%>
