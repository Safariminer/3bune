<?php
$ua = $_SERVER['HTTP_USER_AGENT'];

if(isset($_REQUEST['ua'])){
    $ua = $_REQUEST['ua'];
}

$message = $_REQUEST['message'];
$message = str_replace(array('#{plus}#', '#{amp}#', '#{dcomma}#', '#{percent}#'), array('+', '&', ';', '%'), $message);

include 'config.php';

$message = str_ireplace($threebune_banlist, $threebune_replacement, $message);

$ua = str_replace(array('#{plus}#', '#{amp}#', '#{dcomma}#', '#{percent}#'), array('+', '&', ';', '%'), $ua);
$ua = str_ireplace($threebune_banlist, $threebune_replacement, $ua);
$message= str_replace("%C2%A0", " ", $message);
$ua = str_replace("%C2%A0", " ", $ua);

$referer = $_REQUEST['posturl'];
$referer = substr($referer, 0, strrpos($referer, '/')+1);

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
// add info child to post
// we append $ua as a TextNode to $domPostInfo
// because createElement HTML escaping is very weird
$domPostInfo = $messagelist->createElement("info");
$domPost->appendChild($domPostInfo)->appendChild($messagelist->createTextNode($ua));

// add message child to post (same as info)
$domPostMessage = $messagelist->createElement("message");
$domPost->appendChild($domPostMessage)->appendChild($messagelist->createTextNode($message));

$messagelist->getElementsByTagName('board')->item(0)->appendChild($domPost);
//echo $messagelist->saveXML();
$messagelist->save("backend.xml");
echo file_get_contents("backend.xml");
//echo $ua . "<br/>";
//echo $message . "<br/>";
//echo $referer . "<br/>";
?>