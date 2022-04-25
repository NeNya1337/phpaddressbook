<?php
require_once("src/classes/db.inc.php");
require_once("src/classes/page.inc.php");
$page = new Page("insert");
$page->setPlaceholder("%METHOD%","edit");

if(isset($_REQUEST["id"])){
    $page->setPlaceholder("%ID%",$_REQUEST["id"]);

    $stmt = "SELECT * FROM addresses WHERE id = '".$_REQUEST["id"]."'";
    $result = $page->getDatabase()->dbFetch($stmt);
    foreach($result as $entry){
        $page->setPlaceholder("%NAME%",$entry["name"]);
        $page->setPlaceholder("%CITY%",$entry["city"]);
    }
    echo $page->getHTML();
} else {
    header( "refresh:5;url=index.php" );
    echo 'You\'ll be redirected in about 5 secs. If not, click <a href="index.php">here</a>.';
}