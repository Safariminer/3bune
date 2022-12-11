<?php
$ua = $_SERVER['HTTP_USER_AGENT'];

if(isset($_REQUEST['ua'])){
    $ua = $_REQUEST['ua'];
}

// This block of code was borrowed from OLCC
// sanitize  $_REQUEST inputs
$message = htmlentities($_REQUEST['message']);
$ua = htmlentities($ua);

// I don't know if this should be escaped or not, please tell me
$referer = $_REQUEST['posturl'];
$referer = substr($referer, 0, strrpos($referer, '/')+1);
// End of borrowed from OLCC block. Yes it's only variable declarations. But half the file is that so...
// Thank you Chrisix: https://github.com/chrisix/olcc

$messnumstring = file_get_contents("messnum.txt");
$messnum = (int)$messnumstring;
$messnum = $messnum + 1;
file_put_contents("messnum.txt", (string)$messnum);

$messagelist = new DOMDocument();
$messagelist->load("backend.xml");
// print $messagelist->saveXML();
$domPost = $messagelist->createElement("post");
$domPostid = $messagelist->createAttribute("id");
$domPostid->value = (string)$messnum;
$domPost->appendChild($domPostid);
$domPosttime = $messagelist->createAttribute("time");
$domPosttime->value = date("YmdHis");
$domPost->appendChild($domPosttime);

// add info child to post
// we append $ua as a TextNode to $domPostInfo
// because createElement HTML escaping is very weird
$domPostInfo = $messagelist->createElement("info");
$domPost->appendChild($domPostInfo)->appendChild($messagelist->createTextNode($ua));

// add message child to post (same as info)
$domPostMessage = $messagelist->createElement("message");
$domPost->appendChild($domPostMessage)->appendChild($messagelist->createTextNode($message));;

$messagelist->getElementsByTagName('board')->item(0)->appendChild($domPost);
//echo $messagelist->saveXML();
$messagelist->save("backend.xml");
echo file_get_contents("backend.xml");
//echo $ua . "<br/>";
//echo $message . "<br/>";
//echo $referer . "<br/>";
?>
