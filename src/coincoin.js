// 3bune allows the host to set a secondary CSS file. the second one is disabled by default here.
document.getElementsByTagName('link')[1].disabled = true; 

// we need to refresh the chat every so often. lastID isn't implemented yet, so we really refresh the whole thing
var intervalID = window.setInterval(refreshIframe, document.getElementById('refreshrate').value);

// this is if the user changes their refresh rate
function ResetRefreshRate(){
    if(document.getElementById('refreshrate').value < 500) document.getElementById('refreshrate').value = 500;
    clearTimeout(intervalID)
    intervalID = window.setInterval(refreshIframe, document.getElementById('refreshrate').value);
};

// var focused = document.activeElement;

// this is the function used to changed the CSS used.
function Resister(){
    if(document.getElementsByTagName('link')[0].disabled == true){
        document.getElementsByTagName('link')[0].disabled = false; 
        document.getElementsByTagName('link')[1].disabled = true; 
        return;
    }
    // i tried to make it clean kekw
    document.getElementsByTagName('link')[1].disabled = false; 
    document.getElementsByTagName('link')[0].disabled = true;
};


document.onkeypress = function (e) {
    if (e.keyCode == 13){
        if(document.activeElement.id == "message") PostToServer();
        if(document.activeElement.id == "refreshrate")ResetRefreshRate();
    }
};

var lastnorloge = "";
// this is the norloge function thingy
function GetTime(istruenorloge = false){
    if(istruenorloge) {
        document.getElementById('message').value = document.getElementById('message').value + " " + event.target.innerHTML + " ";
    }
    
    var selector = ".id" + event.target.innerHTML.replaceAll("T", "").replaceAll(":", "").replaceAll("-", "");

    console.log(selector)
    var temp = document.querySelectorAll(selector);
    for (var i = 0; i < temp.length; i++) {
        temp[i].style.color = "black";
        temp[i].style.backgroundColor = "yellow";
    }
    lastnorloge = selector;
};

function ClearTime(){
    var lasttemp = document.querySelectorAll(lastnorloge);
    for (var i = 0; i < lasttemp.length; i++) {
        lasttemp[i].style.color = "white";
        lasttemp[i].style.backgroundColor = "";
    }
}
    
// before you ask, YES, at SOME POINT in 3BUNE's development, there WAS an actual iframe.
// as far as i can see this is the latest commit with an actual iframe:
// https://github.com/Safariminer/3bune/commit/6585d0bcba2f50f19ec7033c8ea931ba0aa5d665
function refreshIframe() {
    document.getElementById("refreshbutton").innerHTML = "Refreshing...";
    fetch("frontend.php?ua=" + document.getElementById('ua').value.trim().replaceAll(/\s/g, '%20')).then(function(response) {
        response.text().then(function(text) {
            document.getElementById('chat').innerHTML = text;
            document.getElementById('chat').scrollTop = document.getElementById('chat').scrollHeight;
        });
    });
    document.getElementById("refreshbutton").innerHTML = "Refresh";
}

// can you guess what these two are for?
function FindTotoz(){
    fetch("totozmanager.php?q=" + document.getElementById("totozfinder").value).then(function(response) {
        response.text().then(function(text) {
            document.getElementById('totozmanager').innerHTML = text;
        });
    });
}

function AddTotoz(){
    document.getElementById('message').value = document.getElementById('message').value + " [:" + event.target.attributes.getNamedItem("alt").value + "] ";
}

// this is just plain horrible
function sleep(milliseconds) {
    const date = Date.now();
    let currentDate = null;
    do {
        currentDate = Date.now();
    } while (currentDate - date < milliseconds);
}

function PostToServer(){
    
    fetch('post.php?ua=' + encodeURI(document.getElementById('ua').value).replaceAll("&", "%26").replaceAll("+", "%2B").replaceAll("#", "%23").replace(/[\u200B-\u200D\uFEFF]/g, '').replaceAll(" ", "%20") + "&message="+ encodeURI(document.getElementById('message').value).replaceAll("&", "%26").replaceAll("+", "%2B").replaceAll("#", "%23").replace(/[\u200B-\u200D\uFEFF]/g, '').replaceAll(" ", "%20"));
    document.getElementById('message').value = "";
    sleep(20);
    refreshIframe();
    
    // posting
}

// This is plain stolen from: https://www.w3schools.com/js/js_cookies.asp
function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
// thank you w3schools, you are amazing

function SaveUsername(){
    setCookie("username", document.getElementById('ua').value, 1500); // should be long enough kekw
}

function onloadfunc(){
    document.getElementById('ua').value = getCookie("username");
    if(getCookie("username") == ""){
        document.getElementById('ua').value = "anonymous moule";
    }
    refreshIframe();
}