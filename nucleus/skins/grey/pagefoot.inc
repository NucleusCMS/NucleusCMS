</div><!-- end of the contents div -->

<!-- definition of the logo (left-top) -->
<div class="logo">
 <img src="<%skinfile(atom.gif)%>" width="150" height="150" alt="" /> 
</div>

<!-- definition of the menu -->
<div class="menu">
 <!-- accessibility anchor -->
 <a name="navigation" id="navigation" class="skip"></a>
 <h1 class="skip">Navigation</h1>

 <h2>Navigation</h2>
 <ul class="nobullets">
  <li><a href="<%todaylink%>">Today</a></li>
  <li><a href="<%archivelink%>">Archives</a></li>
  <li><a href="<%adminurl%>">Admin Area</a></li>
 </ul>

 <h2>Categories</h2>
 <%categorylist(default)%>

 <h2>Search</h2>
 <%searchform%>
 
 <h2>Login</h2>
 <%loginform%>

 <h2>My Links</h2>

 <ul class="nobullets">
  <li><a href="http://nucleuscms.org/" title="This site is Nucleus-powered">Nucleus</a></li>
  <li><a href="http://www.weblogs.com/" title="latest updates">Weblogs.com</a></li>
  <li><a href="http://www.daypop.com/" title="Search news &amp; weblog sites">DayPop</a></li>
  <li><a href="http://www.google.com/" title="Search the web">Google</a></li>
 </ul>

 <h2>powered by</h2>
 <%nucleusbutton(nucleus2.gif,46,43)%>

</div>

</body>
</html>