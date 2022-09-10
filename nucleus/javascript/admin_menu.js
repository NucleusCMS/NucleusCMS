
function drawMenuImage(target_id, size=40, color="black")
{
  var obj = document.getElementById(target_id);
  if (!obj) {
    return false;
  }
  if (obj.width !== size) {
    obj.width = size;
  }
  if (obj.height !== size) {
    obj.height = size;
  }
  var canvas = obj.getContext("2d");
  canvas.lineWidth = size / 9;
  var p = [canvas.lineWidth*2, size/2, size - canvas.lineWidth*2];
  for (var i in p) {
    var offset = Math.round(canvas.lineWidth / 2)+1;
    canvas.beginPath();
    canvas.moveTo(offset       , p[i]);
    canvas.lineTo(size - offset, p[i]);
    canvas.strokeStyle=color;
    canvas.lineCap = 'round';
    canvas.stroke();
  }
  return true;
}

function toggle_menu(onoff)
{
  var menu_region = document.getElementById("menu_region");
  var quickmenu = document.getElementById("quickmenu");
  if (!menu_region || !quickmenu) {
    return false;
  }
  var newflag = menu_region.style.display !== "block" ? "block" : 
                (quickmenu.style.display !== "block" ? "block" : "none");
  if (onoff !== undefined && onoff !== null) {
    newflag = onoff !== "off" ? "block" : "none";
  }
  if (newflag === "block") {  // none ==> block
    menu_region.style.display = "block";
    quickmenu.style.display = "block";
  } else {  // block ==> none
    menu_region.style.display = "none";
    quickmenu.style.display = "none";    
  }
}

window.addEventListener("DOMContentLoaded", function () {
  if (!check_menu_target()) {
    return false;
  }
  if (check_menu_btn()) {
    drawMenuImage("menu_btn", 45);
  }
  window.addEventListener("resize", function () {
    check_resize();
  });
  check_resize();
});

function check_menu_target()
{
  var res = false;
  $list = document.getElementsByTagName("link");
  if ($list) {
    for(var i = 0; i < $list.length; i++) {
      var e = $list[i];
      if (e.href && e.href.toString().match("/styles/admin_(original|contemporary).css$")) {
        res = true;
        break;
      }
    }
  }
  return res;
}

function check_menu_btn()
{
  var header = document.getElementById("header") || (document.getElementsByClassName("header")?document.getElementsByClassName("header")[0]:null);
  if (!header) {
    return false;
  }
  if (document.getElementById("menu_btn")) {
    return true;
  }
  
  var menu_region = document.getElementById("menu_region");

  var menu_btn = document.createElement('canvas');
  menu_btn.id = "menu_btn";
  menu_btn.width  = 1;
  menu_btn.height = 1;
  menu_btn.addEventListener("click", function () { toggle_menu(); });
  header.before(menu_btn);

  if (!menu_region) {
    var menu_region = document.createElement('div');
    menu_region.id = "menu_region";
    menu_region.addEventListener(
        "click",
        function (event) { if (event.target && event.target.id === "menu_region") { toggle_menu('off'); } }
    );
  }
  menu_btn.after(menu_region);

  return true;  
}

function check_resize()
{
  var orientation = (screen.orientation || {}).type || screen.mozOrientation || screen.msOrientation;
  if (orientation) {
    var menu_region = document.getElementById("menu_region");
    if (!menu_region) {
      return false;
    }
    var quickmenu = document.getElementById("quickmenu");
    var old_pos_quickmenu = document.getElementById("old_pos_quickmenu");
    if (!old_pos_quickmenu
        && quickmenu
        && quickmenu.parentNode.id !== "menu_region") {
      // save position
      old_pos_quickmenu = document.createElement("div");
      old_pos_quickmenu.id = "old_pos_quickmenu";
      old_pos_quickmenu.style.display = "none";
      quickmenu.parentNode.insertBefore(old_pos_quickmenu, quickmenu);
    }
    if (!old_pos_quickmenu || !quickmenu) {
      return false;
    }
    if (screen.width < 720) {
      if (quickmenu.parentNode.id !== "menu_region" ) {
        menu_region.appendChild(quickmenu);
      }
      toggle_menu("off");
      setMenuCSS(true);
    } else {
      if (quickmenu.parentNode.id === "menu_region" ) {
        old_pos_quickmenu.parentNode.insertBefore(quickmenu, old_pos_quickmenu);
      }
      setMenuCSS(false);
    }
  }
}

function setMenuCSS(visible = true)
{
   var menu_btn = $("#menu_btn");
   var menu_region  = $("#menu_region");
   var quickmenu = $("#quickmenu");
   var content = $("#content");
   
   if (!menu_btn || !menu_region) {
     return;
   }
   
   if (visible) {
     // menu_btn
    menu_btn.css("display",  "block");
    menu_btn.css("position", "fixed");
    // menu_region
    menu_region.css("position", "fixed");
    menu_region.css("z-index", 1000);
    menu_region.css("width", "100%");
    menu_region.css("height", "100%");
    menu_region.css("overflow", "scroll");
    menu_region.css("background-color", "rgba(255, 251, 182, 0.2)");
    
    // quickmenu
    quickmenu.css("top", "60px");
    quickmenu.css("display", "block");
    // content
    if (content) {
      content.css("margin", 0);
    }    
  } else {
    // menu_btn
    menu_btn.css("display",  "none");
    // menu_region
    menu_region.css("display",  "none");
    
    // restore css
    // quickmenu
    quickmenu.css("top", "");
    quickmenu.css("display", "");
    // content
    if (content) {
      content.css("margin", "");
    }
  }
}
