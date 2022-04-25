<?php
require_once("src/classes/db.inc.php");
require_once("src/classes/page.inc.php");
$page = new Page();

$page->setPlaceholder("%HEAD%", $page->load("head"));
$page->setPlaceholder("%HEADER%", $page->load("header"));
$page->setPlaceholder("%CONTENT%", $page->load("content"));
$page->setPlaceholder("%TABLE%", $page->load("table"));

$stmt = "SELECT * FROM addresses";

$result = $page->getDatabase()->dbfetch($stmt);

$rows = "";
foreach($result as $entry){
    $row = $page->load("row");
    $row = str_replace("%NUMBER%", $entry["id"], $row);
    $row = str_replace("%NAME%", $entry["name"], $row);
    $row = str_replace("%CITY%", $entry["city"], $row);
    $rows .= $row;
}

$page->setPlaceholder("%ROW%", $rows);

$page->setPlaceholder("%FOOTER%", $page->load("footer"));



echo $page->getHTML();