<?php
$ua = $_REQUEST['ua'];

// This block of code was borrowed from OLCC
$message = $_REQUEST['message'];
$message = str_replace(array('#{plus}#', '#{amp}#', '#{dcomma}#', '#{percent}#'), array(urlencode('+'), urlencode('&'), '%3B', '%25'), $message);
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
$domPost = $messagelist->createElement("post", "");
$domPostid = $messagelist->createAttribute("id");
$domPostid->value = (string)$messnum;
$domPost->appendChild($domPostid);
$domPosttime = $messagelist->createAttribute("time");
$domPosttime->value = date("YmdHis");
$domPost->appendChild($domPosttime);
$domPostInfo = $messagelist->createElement("info", $ua);
$domPost->appendChild($domPostInfo);
$domPostMessage = $messagelist->createElement("message", $message);
$domPost->appendChild($domPostMessage);

$messagelist->getElementsByTagName('board')->item(0)->appendChild($domPost);
//echo $messagelist->saveXML();
$messagelist->save("backend.xml");
echo file_get_contents("backend.xml");
//echo $ua . "<br/>";
//echo $message . "<br/>";
//echo $referer . "<br/>";
?>