document.getElementsByTagName('link')[1].disabled = true; 
var intervalID = window.setInterval(refreshIframe, document.getElementById('refreshrate').value);
function ResetRefreshRate(){
    if(document.getElementById('refreshrate').value < 500) document.getElementById('refreshrate').value = 500;
    clearTimeout(intervalID)
    intervalID = window.setInterval(refreshIframe, document.getElementById('refreshrate').value);
};
var focused = document.activeElement;
function Resister(){
    if(document.getElementsByTagName('link')[0].disabled == true){
        document.getElementsByTagName('link')[0].disabled = false; 
        document.getElementsByTagName('link')[1].disabled = true; 
        return;
    }
    document.getElementsByTagName('link')[1].disabled = false; 
    document.getElementsByTagName('link')[0].disabled = true;
};
function TimeLookup(){
    $("." + event.target.innerHTML).addClass(".highlighted");
    sleep(5000);
    $("." + event.target.innerHTML).removeClass(".highlighted");
};

document.onkeypress = function (e) {
    if (e.keyCode == 13){
        if(document.activeElement.id == "message") PostToServer();
        if(document.activeElement.id == "refreshrate")ResetRefreshRate();
    }
};

var lastnorloge = "";
function GetTime(){
    // alert(event.target.inne
    document.getElementById('message').value = "tag:" + event.target.innerHTML + " --- " + document.getElementById('message').value;
    if(lastnorloge != ""){
        var lasttemp = document.querySelectorAll(lastnorloge);
        for (var i = 0; i < lasttemp.length; i++) {
            lasttemp[i].style.color = "white";
            lasttemp[i].style.backgroundColor = "black";
        }
    }
    var selector = ".id" + event.target.innerHTML;
    console.log(selector)
    var temp = document.querySelectorAll(selector);
    for (var i = 0; i < temp.length; i++) {
        temp[i].style.color = "black";
        temp[i].style.backgroundColor = "yellow";
    }
    lastnorloge = selector;
};
    

function refreshIframe() {
    fetch("/frontend.php?ua=" + document.getElementById('ua').value.trim().replace(/\s/g, '%20')).then(function(response) {
        response.text().then(function(text) {
            document.getElementById('chat').innerHTML = text;
            document.getElementById('chat').scrollTop = document.getElementById('chat').scrollHeight;
        });
    });
}

function FindTotoz(){
    fetch("/totozmanager.php?q=" + document.getElementById("totozfinder").value).then(function(response) {
        response.text().then(function(text) {
            document.getElementById('totozmanager').innerHTML = text;
        });
    });
}

function AddTotoz(){
    document.getElementById('message').value = document.getElementById('message').value + " [:" + event.target.attributes.getNamedItem("alt").value + "] ";
}

function sleep(milliseconds) {
    const date = Date.now();
    let currentDate = null;
    do {
        currentDate = Date.now();
    } while (currentDate - date < milliseconds);
}
function PostToServer(){
    
    fetch('/post.php?ua=' + document.getElementById('ua').value.trim().replace(/\s/g, '%20') + "&message="+ document.getElementById('message').value.trim().replace(/\s/g, '%20'));
    document.getElementById('message').value = "";
    sleep(20);
    refreshIframe();
    
    
}