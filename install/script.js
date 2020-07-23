onload = function () {
    document.forms[0].reset();
}
var submitcount = 0;

function db_change(db_type) {
    var elm_sqlite = document.getElementById("install_db_type_sqlite");
    var elm_mysql = document.getElementById("install_db_type_mysql");

    var elm_install_db_host = document.getElementById("install_db_host");
    var elm_install_db_create = document.getElementById("install_db_create");
    var elm_install_db_database = document.getElementById("install_db_database");
    var elm_install_db_password = document.getElementById("install_db_password");
    var elm_install_db_user = document.getElementById("install_db_user");
    var elm_install_db_usePrefix = document.getElementById("install_db_usePrefix");
    var elm_charset = document.getElementById("charset");

    if (!elm_mysql) {
//    return ;
    }

    if (elm_mysql.checked) {
        document.getElementById("db_login_data").style.display = "block";
        document.getElementById("db_login_data_sqlite").style.display = "none";
        elm_install_db_host.style.display = "block";
        elm_install_db_user.style.display = "block";
        elm_install_db_password.style.display = "block";
        elm_charset.disabled = 0;
    } else {
        document.getElementById("db_login_data_sqlite").style.display = "block";
        document.getElementById("db_login_data").style.display = "none";
        elm_install_db_host.style.display = "none";
        elm_install_db_user.style.display = "none";
        elm_install_db_password.style.display = "none";
        elm_charset.selectedIndex = 0;
        elm_charset.disabled = 1;
    }
}

// function to make sure the submit button only gets pressed once
function checkSubmit() {
    if (submitcount == 0) {
        submitcount++;
        return true;
    } else {
        return false;
    }
}
