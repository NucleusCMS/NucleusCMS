<div class="sidebar">
	<dl class="sidebardl">
	<dt>Navigation</dt>
	
	<%if(skintype,archive)%>
	<dd><a href="<%prevlink%>" title="Previous month">Previous <%archivetype%></a></dd>
	<dd><a href="<%nextlink%>" title="Next month">Next <%archivetype%></a></dd>
	<dd><a href="<%todaylink%>" title="Today's entry">Today</a></dd>
	<dd><a href="<%archivelink%>" title="Archives">Archives</a></dd>
	<%endif%>
	
	<%if(skintype,archivelist)%>
	<dd><a href="<%todaylink%>" title="Today's entry">Today</a></dd>
	<dd><a href="<%archivelink%>" title="Archives">Archives</a></dd>
	<%endif%>
	
	<%if(skintype,error)%>
	<dd><a href="<%todaylink%>" title="Today's entry">Today</a></dd>
	<%endif%>
	
	<%if(skintype,index)%>
	<dd><a href="<%todaylink%>" title="Today's entry">Today</a></dd>
	<dd><a href="<%archivelink%>" title="Archives">Archives</a></dd>
	<%endif%>
	
	<%if(skintype,item)%>
	<dd><a href="<%nextlink%>" title="Previous item">Previous Item</a></dd>
	<dd><a href="<%prevlink%>" title="Next item">Next Item</a></dd>
	<dd><a href="<%todaylink%>" title="Today's entry">Today</a></dd>
	<dd><a href="<%archivelink%>" title="Archives">Archives</a></dd>
	<%endif%>
	
	<%if(skintype,member)%>
	<dd><a href="<%todaylink%>" title="Today's entry">Today</a></dd>
	<%endif%>
	
	<%if(skintype,search)%>
	<dd><a href="<%todaylink%>" title="Today's entry">Today</a></dd>
	<dd><a href="<%archivelink%>" title="Archives">Archives</a></dd>
	<%endif%>
	
	<%if(loggedin)%>
	<dd><a href="<%adminurl%>" title="Admin Area">Admin</a></dd>
	<%endif%>
	</dl>
</div>
    
<%if(skintype,error)%><%else%>
<%if(skintype,member)%><%else%>
<div class="sidebar">
	<dl class="sidebardl">
	<dt>Categories</dt>
	<%categorylist(default/short)%>
	</dl>
</div>
<%endif%><%endif%>

<div class="sidebar">
	<dl class="sidebardl">
	<dt>Search</dt>
	<dd><%searchform%></dd>
	</dl>
</div>

<div class="sidebar">
	<dl class="sidebardl">
	<dt>Login</dt>
	<dd><%loginform%></dd>
	</dl>
</div>

<div class="sidebar">
	<dl class="sidebardl">
	<dt>Links</dt>
	<dd><a href="http://nucleuscms.org" title="Nucleus CMS Home">nucleuscms.org</a></dd>
	<dd><a href="http://docs.nucleuscms.org/" title="Nucleus Documentation">docs.nucleuscms.org</a></dd>
	<dd><a href="http://forum.nucleuscms.org" title="Nucleus Support Forum">forum.nucleuscms.org</a></dd>
	<dd><a href="http://wiki.nucleuscms.org/" title="Nucleus Wiki">wiki.nucleuscms.org</a></dd>
	<dd><a href="http://skins.nucleuscms.org/" title="Nucleus Skins">skins.nucleuscms.org</a></dd>
	<dd><a href="http://wiki.nucleuscms.org/plugin" title="Nucleus Plugins">plugins.nucleuscms.org</a></dd>
	<dd><a href="http://dev.nucleuscms.org/" title="Nucleus Developer Network">dev.nucleuscms.org</a></dd>
	</dl>
</div>

<div class="sidebar">
	<div class="sidebardl centerize">
	<a href="http://www.spreadfirefox.com/?q=affiliates&amp;id=8758&amp;t=1" title="Switch to a safer browser today">Spread Firefox!</a>
	</div>
</div>
