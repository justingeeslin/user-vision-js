function log(e) {
    console.log('Click', e);
}

function save() {
    console.log('Saving session..');

    var url = "save.php";
    var params = "lorem=ipsum&name=alpha";
    var xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);

    //Send the proper header information along with the request
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.send(params);
}
  
document.body.addEventListener("click", log);

window.addEventListener("unload", save);

// window.onunload = function() {
//     save();
// }