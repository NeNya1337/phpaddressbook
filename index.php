<?php
require_once("src/classes/db.inc.php");
require_once("src/classes/page.inc.php");

$page = new Page("overview");
if(isset($_REQUEST)){
    $page->getDatabase()->insertAddress($_REQUEST);
}


$page->setPlaceholder("%TABLE%", $page->load("table"));

$stmt = "SELECT * FROM addresses";

$result = $page->getDatabase()->dbFetch($stmt);

$rows = "";
foreach($result as $entry){
    $row = $page->load("row");
    $row = str_replace("%NUMBER%", $entry["id"], $row);
    $row = str_replace("%NAME%", $entry["name"], $row);
    $row = str_replace("%CITY%", $entry["city"], $row);
    $rows .= $row;
}

$page->setPlaceholder("%ROW%", $rows);




echo $page->getHTML();