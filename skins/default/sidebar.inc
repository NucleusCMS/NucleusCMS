<!-- page menu -->
<div class="sidebar">
<dl class="sidebardl">
<dt><%_(Navigation)%></dt>

<!-- archive: navigation -->
<%if(skintype,archive)%>
<%if(archiveprevexists)%>
<dd><a href="<%prevlink%>" title="<%_(Previous month)%>"><%_(Previous)%> <%archivetype%></a></dd>
<%else%>
<dd>&nbsp;</dd>
<%endif%>
<%if(archivenextexists)%>
<dd><a href="<%nextlink%>" title="Next month"><%_(Next)%> <%archivetype%></a></dd>
<%else%>
<dd>&nbsp;</dd>
<%endif%>
<dd><a href="<%todaylink%>" title="<%_(Today's entry)%>"><%_(Today)%></a></dd>
<dd><a href="<%archivelink%>" title="<%_(Archives)%>"><%_(Archives)%></a></dd>
<%endif%>

<!-- archivelist: navigation -->
<%if(skintype,archivelist)%>
<dd><a href="<%todaylink%>" title="<%_(Today's entry)%>"><%_(Today)%></a></dd>
<dd><a href="<%archivelink%>" title="<%_(Archives)%>"><%_(Archives)%></a></dd>
<%endif%>

<!-- error: navigation -->
<%if(skintype,error)%>
<dd><a href="<%todaylink%>" title="<%_(Today's entry)%>"><%_(Today)%></a></dd>
<%endif%>

<!-- index: navigation -->
<%if(skintype,index)%>
<dd><a href="<%todaylink%>" title="<%_(Today's entry)%>"><%_(Today)%></a></dd>
<dd><a href="<%archivelink%>" title="<%_(Archives)%>"><%_(Archives)%></a></dd>
<%endif%>

<!-- item: navigation -->
<%if(skintype,item)%>
<dd><a href="<%nextlink%>" title="<%_(Previous item)%>"><%_(Previous item)%></a></dd>
<dd><a href="<%prevlink%>" title="<%_(Next item)%>"><%_(Next item)%></a></dd>
<dd><a href="<%todaylink%>" title="<%_(Today's entry)%>"><%_(Today)%></a></dd>
<dd><a href="<%archivelink%>" title="<%_(Archives)%>"><%_(Archives)%></a></dd>
<%endif%>

<!-- member: navigation -->
<%if(skintype,member)%>
<dd><a href="<%todaylink%>" title="<%_(Today's entry)%>"><%_(Today)%></a></dd>
<%endif%>

<!-- search: navigation -->
<%if(skintype,search)%>
<dd><a href="<%todaylink%>" title="<%_(Today's entry)%>"><%_(Today)%></a></dd>
<dd><a href="<%archivelink%>" title="<%_(Archives)%>"><%_(Archives)%></a></dd>
<%endif%>

<!-- admin link, only visible if logged in -->
<%if(loggedin)%>
<dd><a href="<%adminurl%>" title="<%_(Admin Area)%>"><%_(Admin)%></a></dd>
<dd><a href="<%addlink%>" onclick="<%addpopupcode%>" title="<%_(Add an item to your blog)%>"><%_(Add an item)%></a></dd>
<%endif%>
</dl>
</div>

<!-- category list, not on error or member page -->
<%if(skintype,error)%><%else%>
<%if(skintype,member)%><%else%>
<div class="sidebar">
<dl class="sidebardl">
<dt><%_(Categories)%></dt>
<%categorylist(default/index)%>
</dl>
</div>
<%endif%><%endif%>

<!-- bloglist-->
<div class="sidebar">
<dl class="sidebardl">
<dt><%_(Blogs)%></dt>
<%bloglist(default/index)%>
</dl>
</div>

<!-- search form -->
<div class="sidebar">
<dl class="sidebardl">
<dt><%_(Search)%></dt>
<dd><%searchform%></dd>
</dl>
</div>

<!-- login form -->
<div class="sidebar">
<dl class="sidebardl">
<dt><%_(Login)%></dt>
<dd><%loginform%></dd>
</dl>
</div>

<!-- links -->
<div class="sidebar">
<dl class="sidebardl">
<dt><%_(Links)%></dt>
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