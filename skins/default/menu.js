
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
  var sidebarcontainer = document.getElementById("sidebarcontainer");
  var newflag = sidebarcontainer.style.display !== "block" ? "block" : "none";
  if (onoff !== undefined && onoff !== null) {
    newflag = onoff !== "off" ? "block" : "none";
  }
  if (!menu_region || !sidebarcontainer) {
    return false;
  }
  if (newflag === "block") {  // none ==> block
    menu_region.style.display = "block";
    sidebarcontainer.style.display = "block";
  } else {  // block ==> none
    menu_region.style.display = "none";
    sidebarcontainer.style.display = "none";    
  }  
}

window.addEventListener("DOMContentLoaded", function () {
  if (check_menu_btn()) {
    drawMenuImage("menu_btn", 45);
  }
  window.addEventListener("resize", function () {
    check_resize();
  });
  check_resize();
});

function check_menu_btn()
{
  var header = document.getElementById("header");
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
    menu_region.addEventListener("click", function () { toggle_menu('off'); });
    menu_btn.after(menu_region);
  }

  return true;  
}

function check_resize()
{
  var orientation = (screen.orientation || {}).type || screen.mozOrientation || screen.msOrientation;
  if (orientation) {
    var menu_region = document.getElementById("menu_region");
    var sidebarcontainer = document.getElementById("sidebarcontainer");
    var old_pos_sidebarcontainer = document.getElementById("old_pos_sidebarcontainer");
    if (!old_pos_sidebarcontainer
        && sidebarcontainer
        && sidebarcontainer.parentNode.id !== "menu_region") {
      // save position
      old_pos_sidebarcontainer = document.createElement("div");
      old_pos_sidebarcontainer.id = "old_pos_sidebarcontainer";
      old_pos_sidebarcontainer.style.display = "none";
      sidebarcontainer.parentNode.insertBefore(old_pos_sidebarcontainer, sidebarcontainer);
    }
    if (screen.width < 720) {
      if (menu_region && sidebarcontainer
          && sidebarcontainer.parentNode.id !== "menu_region" ) {
        menu_region.appendChild(sidebarcontainer);
      }
      toggle_menu("off");
    } else {
      if (sidebarcontainer && old_pos_sidebarcontainer
          && sidebarcontainer.parentNode.id === "menu_region" ) {
        old_pos_sidebarcontainer.parentNode.insertBefore(sidebarcontainer, old_pos_sidebarcontainer);
      }
    }
  }  
}