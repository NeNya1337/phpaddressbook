<?php
require_once("src/classes/db.inc.php");
require_once("src/classes/page.inc.php");

$page = new Page("overview");
if(isset($_REQUEST["method"]) && isset($_REQUEST["name"]) && isset($_REQUEST["city"])){
    switch($_REQUEST["method"]){
        case "edit":
            if(isset($_REQUEST["id"])){
                $page->getDatabase()->editAddress($_REQUEST["id"], $_REQUEST);
            }
            break;
        case "insert":
            $page->getDatabase()->insertAddress($_REQUEST);
            break;
        default: break;
    }
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