<?php

/**
 * This is the edit page.
 *
 * It shows a prefilled form with the record you want to add.
 *
 * @author Mark Lösche
 */
require_once("lib/classes/db.inc.php");
require_once("lib/classes/page.inc.php");
$page = new Page("insert");
$page->setPlaceholder("%METHOD%","edit");

if(isset($_REQUEST["id"])){
    $page->setPlaceholder("%ID%",$_REQUEST["id"]);

    $stmt = "SELECT * FROM addresses WHERE id = '".$_REQUEST["id"]."'";
    $result = $page->getDatabase()->dbFetch($_REQUEST["id"]);
    foreach($result as $entry){
        $page->setPlaceholder("%NAME%",$entry["name"]);
        $page->setPlaceholder("%CITY%",$entry["city"]);
    }
    echo $page->getHTML();
} else {
    echo "Oops, something went wrong! Navigate back or click <a href='index.php'>here</a>.";
}