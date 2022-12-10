<?php
$ua = "anonymousmoule";

// So this was borrowed from OLCC
if(isset($_REQUEST['ua'])) {
    $ua = $_REQUEST['ua'];
}
$message = $_REQUEST['postdata'];
$message = str_replace(array('#{plus}#', '#{amp}#', '#{dcomma}#', '#{percent}#'), array(urlencode('+'), urlencode('&'), '%3B', '%25'), $message);
$referer = $_REQUEST['posturl'];
$referer = substr($referer, 0, strrpos($referer, '/')+1);
// End of borrowed from OLCC block. Yes it's only variable declarations. But half the file is that so...
// Thank you Chrisix: https://github.com/chrisix/olcc

$messnumstring = file_get_contents("messnum.txt");
$messnum = (int)$messnumstring;
$messnum = $messnum + 1;

$messagelist = new DOMDocument();
$messagelist->load("backend.xml");
// print $messagelist->saveXML();
$domPost = $messagelist->createElement("post", "");
$domPostid = $messagelist->createAttribute("id");
$domPostid->value = (string)$messnum;
$domPost->appendChild($domPostid);
$messagelist->getElementsByTagName('board')->item(0)->appendChild($domPost);

echo $messagelist->saveXML();
?>