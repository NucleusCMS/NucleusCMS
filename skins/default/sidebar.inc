<!-- page menu -->
<div class="sidebar">
<dl class="sidebardl">
<dt>Navigation</dt>

<!-- archive: navigation -->
<%if(skintype,archive)%>
<%if(archiveprevexists)%>
<dd><a href="<%prevlink%>" title="Previous month">Previous <%archivetype%></a></dd>
<%else%>
<dd>&nbsp;</dd>
<%endif%>
<%if(archivenextexists)%>
<dd><a href="<%nextlink%>" title="Next month">Next <%archivetype%></a></dd>
<%else%>
<dd>&nbsp;</dd>
<%endif%>
<dd><a href="<%todaylink%>" title="Today's entry">Today</a></dd>
<dd><a href="<%archivelink%>" title="Archives">Archives</a></dd>
<%endif%>

<!-- archivelist: navigation -->
<%if(skintype,archivelist)%>
<dd><a href="<%todaylink%>" title="Today's entry">Today</a></dd>
<dd><a href="<%archivelink%>" title="Archives">Archives</a></dd>
<%endif%>

<!-- error: navigation -->
<%if(skintype,error)%>
<dd><a href="<%todaylink%>" title="Today's entry">Today</a></dd>
<%endif%>

<!-- index: navigation -->
<%if(skintype,index)%>
<dd><a href="<%todaylink%>" title="Today's entry">Today</a></dd>
<dd><a href="<%archivelink%>" title="Archives">Archives</a></dd>
<%endif%>

<!-- item: navigation -->
<%if(skintype,item)%>
<dd><a href="<%nextlink%>" title="Previous item">Previous Item</a></dd>
<dd><a href="<%prevlink%>" title="Next item">Next Item</a></dd>
<dd><a href="<%todaylink%>" title="Today's entry">Today</a></dd>
<dd><a href="<%archivelink%>" title="Archives">Archives</a></dd>
<%endif%>

<!-- member: navigation -->
<%if(skintype,member)%>
<dd><a href="<%todaylink%>" title="Today's entry">Today</a></dd>
<%endif%>

<!-- search: navigation -->
<%if(skintype,search)%>
<dd><a href="<%todaylink%>" title="Today's entry">Today</a></dd>
<dd><a href="<%archivelink%>" title="Archives">Archives</a></dd>
<%endif%>

<!-- admin link, only visible if logged in -->
<%if(loggedin)%>
<dd><a href="<%adminurl%>" title="Admin Area">Admin</a></dd>
<%endif%>
</dl>
</div>

<!-- category list, not on error or member page -->
<%if(skintype,error)%><%else%>
<%if(skintype,member)%><%else%>
<div class="sidebar">
<dl class="sidebardl">
<dt>Categories</dt>
<%categorylist(default/index)%>
</dl>
</div>
<%endif%><%endif%>

<!-- bloglist-->
<div class="sidebar">
<dl class="sidebardl">
<dt>Blogs</dt>
<%bloglist(default/index)%>
</dl>
</div>

<!-- search form -->
<div class="sidebar">
<dl class="sidebardl">
<dt>Search</dt>
<dd><%searchform%></dd>
</dl>
</div>

<!-- login form -->
<div class="sidebar">
<dl class="sidebardl">
<dt>Login</dt>
<dd><%loginform%></dd>
</dl>
</div>

<!-- links -->
<div class="sidebar">
<dl class="sidebardl">
<dt>Links</dt>
<dd><a href="http://nucleuscms.org" title="Nucleus CMS Home">nucleuscms.org</a></dd>
<dd><a href="http://docs.nucleuscms.org/" title="Nucleus CMS Documentation">docs.nucleuscms.org</a></dd>
<dd><a href="http://forum.nucleuscms.org" title="Nucleus CMS Support Forum">forum.nucleuscms.org</a></dd>
<dd><a href="http://wiki.nucleuscms.org/" title="Nucleus CMS Wiki">wiki.nucleuscms.org</a></dd>
<dd><a href="http://skins.nucleuscms.org/" title="Nucleus CMS Skins">skins.nucleuscms.org</a></dd>
<dd><a href="http://wiki.nucleuscms.org/plugin" title="Nucleus CMS Plugins">plugins.nucleuscms.org</a></dd>
<dd><a href="http://dev.nucleuscms.org/" title="Nucleus Developer Network">dev.nucleuscms.org</a></dd>
</dl>
</div>

<!-- Powered by -->
<div class="sidebar">
<div class="sidebardl centerize">
<%nucleusbutton(images/nucleus.gif,85,31)%>
</div>
</div>