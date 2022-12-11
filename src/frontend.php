<?php
// Converts backend.xml into actual HTML for the chat

function TreatString($message): string{
    // if there is a "tag:..." with 14 digits after at the beginning
    // of the message, generate a clickable object to get to the message
    // with same 14 digits timestamp
    $finalmessage = preg_replace(
        "/^tag:([0-9]{14})/",
        
        "tag:<span id=\"$1\" mouseover\"TimeLookup()\"" .
        " onclick=\"GetTime()\">$1</span> ---",
        
        htmlentities($message));

    return (string)$finalmessage;
}

$messagelist = new DOMDocument();
$messagelist->load('backend.xml');

$messages = $messagelist->getElementsByTagName('post');

foreach($messages as $message){
    echo "<time mouseover=\"TimeLookup()\" onclick=\"GetTime()\" id=\"" . $message->getAttribute('time') . "\">" . $message->getAttribute('time') . "</time> | " . htmlentities($message->childNodes->item(0)->textContent) . " : " . TreatString($message->childNodes->item(1)->textContent) . "<br/>";
}

?>
<span id="end"></span>
