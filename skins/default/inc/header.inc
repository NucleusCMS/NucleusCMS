<!-- page header -->
<div id="header"><a name="top"></a>
<h1>
	<%if(skintype,error)%>
		<a href="<%sitevar(url)%>"><%sitevar(name)%></a>
	<%elseif(skintype,member)%>
		<a href="<%sitevar(url)%>"><%sitevar(name)%></a>
	<%else%>
		<a href="<%blogsetting(url)%>"><%blogsetting(name)%></a>
	<%endif%>
</h1>
</div>
