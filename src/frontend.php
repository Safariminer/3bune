<?php
// Converts backend.xml into actual HTML for the chat

function TreatString($message): string{
    $message = htmlspecialchars($message);
    $finalmessage = $message;
    // check for norloges
    if(stripos($message, "tag:") === 0){
        $finalmessage = substr($message, 0, 22);
        $tag = $finalmessage;
        $finalmessage = "tag:<span id=\"" . substr($tag, 4, 14);
        $finalmessage = $finalmessage . "\" mouseover=\"TimeLookup()\" onclick=\"GetTime()\">" . substr($tag, 4, 14);
        $finalmessage = $finalmessage . "</span> ---";
        $finalmessage = $finalmessage . substr($message, 22);
    }

    return (string)$finalmessage;
}

$messagelist = new DOMDocument();
$messagelist->load('backend.xml');

$messages = $messagelist->getElementsByTagName('post');

foreach($messages as $message){
    echo "<time mouseover=\"TimeLookup()\" onclick=\"GetTime()\" id=\"" . $message->getAttribute('time') . "\">" . $message->getAttribute('time') . "</time> | " . htmlspecialchars($message->childNodes->item(0)->textContent) . " : " . TreatString($message->childNodes->item(1)->textContent) . "<br/>";
}

?>
<span id="end"></span>