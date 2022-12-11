<?php
// Converts backend.xml into actual HTML for the chat

$messagelist = new DOMDocument();
$messagelist->load('backend.xml');

$messages = $messagelist->getElementsByTagName('post');

foreach($messages as $message){
    echo "<time mouseover=\"TimeLookup()\" onclick=\"GetTime()\" id=\"" . $message->getAttribute('time') . "\">" . $message->getAttribute('time') . "</time> | " . $message->childNodes->item(0)->textContent . " : " . $message->childNodes->item(1)->textContent . "<br/>";
}

?>
<span id="end"></span>