<?php
$xmltext = file_get_contents("https://totoz.eu/search.xml?terms=" . urlencode($_GET['q']));

$xml = new DOMDocument();
$xml->loadXML($xmltext);

$totozlist = $xml->getElementsByTagName('totoz');

// Unless totoz.eu changes the way it works, the first child of the totoz is its name, the second is the author
// and the very last is if it's NSFW

foreach($totozlist as $totoz){
    echo "<img onclick=\"AddTotoz()\" alt=\"" . $totoz->childNodes->item(1)->textContent ."\" src=\"https://totoz.eu/img/" . $totoz->childNodes->item(1)->textContent . "\"/><br/>" . $totoz->childNodes->item(1)->textContent;
    echo "<br/>by " . $totoz->childNodes->item(3)->textContent;
    echo "<br/><hr/>";
}
?>