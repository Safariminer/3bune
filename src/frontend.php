<?php
// Converts backend.xml into actual HTML for the chat

function TreatString($message): string{
    // here's the actual standard code
    $finalmessage = preg_replace(
        "/([0-9]{4})-([0-9]{2})-([0-9]{2})T([0-9]{2}):([0-9]{2}):([0-9]{2})/",
        "<span class=\"id$1$2$3$4$5$6\" onmouseout=\"ClearTime()\" onmouseover=\"GetTime()\" onclick=\"GetTime(true)\">$1-$2-$3T$4:$5:$6</span>",
        htmlentities($message)
    );
    
    $finalmessage = str_ireplace(htmlentities($_REQUEST["ua"] . "<"), "<span style=\"background-color: red;\">" . $_REQUEST["ua"] . htmlentities("< ") . "</span>", $finalmessage);
    $finalmessage = preg_replace("/==&gt;[\s|&#xA0;](.+)[\s|&#xA0;]&lt;==/", "<b style=\"color:yellow\">==&gt; $1 &lt;==</b>", $finalmessage);
    $finalmessage = preg_replace("/\">==&gt; nbsp;/", "\">==&gt; ", $finalmessage);
    $finalmessage = preg_replace("/\[steam:([0-9]+)\]/", "<a style=\"color:#5bcefa;\" href=\"https://store.steampowered.com/app/$1\">[steam:$1]</a>", $finalmessage);
    $finalmessage = preg_replace("/\[:([^\]]+)\]/", "<img src=\"https://totoz.eu/img/$1\" title=\"$1\" onclick=\"alert('Looking at: [:$1]')\">", $finalmessage);
    $finalmessage = preg_replace("/\*\*(.+)\*\*/", "<b>$1</b>", $finalmessage);
    $finalmessage = preg_replace("/\*(.+)\*/", "<i>$1</i>", $finalmessage);
    $finalmessage = preg_replace("/\[url:(.+)\]/", "<a style=\"color:#5bcefa;\" href=\"$1\">[url:$1]</a>", $finalmessage);
    $finalmessage = str_ireplace("[welcomeuser]", "<div>" . file_get_contents("welcome.html") . "</div>", $finalmessage);
    $finalmessage = preg_replace("/\[zoodelagommette:(.+)\]/", "<span style=\"color: #f11;background-color:darkgreen;\"><b>$1</b></span>", $finalmessage);
    
    // $finalmessage = str_replace("[:", "<img src=\"https://totoz.eu/img/", $finalmessage);
    
    // $finalmessage = str_replace("]", "\">", $finalmessage);
    
    return (string)$finalmessage;
}

$messagelist = new DOMDocument();
$messagelist->load('backend.xml');

$messages = $messagelist->getElementsByTagName('post');

foreach($messages as $message){
    echo "<time onmouseover=\"GetTime()\" onmouseout=\"ClearTime()\" onclick=\"GetTime(true)\" class=\"id" . preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/","$1$2$3$4$5$6\">$1-$2-$3T$4:$5:$6</time>", $message->getAttribute('time')) . " | " . htmlentities($message->childNodes->item(0)->textContent) . " : " . TreatString($message->childNodes->item(1)->textContent) . "<br/>";
    // holy sh&$@t that is one long line of code. 
}

?>
<span id="end"></span>
