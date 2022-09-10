<body>
<!-- page header -->
<div id="header"><a name="top"></a>
<h1>
	<%if(skintype,error)%>
		<a href="<%sitevar(url)%>" accesskey="1"><%sitevar(name)%></a>
	<%else%>
	<%if(skintype,member)%>
		<a href="<%sitevar(url)%>" accesskey="1"><%sitevar(name)%></a>
	<%else%>
		<a href="<%blogsetting(url)%>" accesskey="1"><%blogsetting(name)%></a>
	<%endif%>
	<%endif%>
</h1>
</div>

<!-- begin wrapper divs -->
<div id="mainwrapper">
<div id="wrapper">