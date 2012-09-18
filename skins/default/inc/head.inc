<meta http-equiv="Content-Type" content="text/html; charset=<%charset%>" />
<%phpinclude(inc/benchmark.inc)%>

<!-- meta information for search engines -->
<meta name="name" content="<%blogsetting(name)%>" />
<meta name="description" content="<%blogsetting(desc)%>" />

<!-- site stylesheet (site colors and layout definitions) -->
<link rel="stylesheet" type="text/css" href="<%skinfile(default_left.css)%>" />

<!-- site stylesheet ADDED (some adjustment) -->
<link rel="stylesheet" type="text/css" href="<%skinfile(jlocal.css)%>" />

<!-- tooltips & stylesheet (activated by title="" on links) -->
<link rel="stylesheet" type="text/css" href="<%skinfile(nicetitle.css)%>" />
<script type="text/javascript" src="<%skinfile(nicetitle.js)%>"></script>

<!-- ATOM support --> 
<link rel="alternate" type="application/atom+xml" title="ATOM" href="atom.php" /> 

<!-- RSS 2.0 feed -->
<link rel="alternate" type="application/rss+xml" title="RSS" href="<%sitevar(url)%>xml-rss2.php" />

<!-- favorite icon -->
<link rel="shortcut icon" href="<%skinfile(favicon.ico)%>" />
<link rel="icon" href="<%skinfile(favicon.ico)%>" />
