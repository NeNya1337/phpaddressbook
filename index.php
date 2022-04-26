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
if(isset($_REQUEST["instant"]) && isset($_REQUEST["id"])){
    $page->getDatabase()->deleteAddress($_REQUEST["id"]);
}

$page->setPlaceholder("%TABLE%", $page->load("table"));

$order_key = "id";
$order_mode = "asc";

if(isset($_REQUEST["order_key"]) && isset($_REQUEST["order_mode"])){
    $order_key = $_REQUEST["order_key"];
    $order_mode = $_REQUEST["order_mode"];
}

$page->setPlaceholder("%HOKVALUE%", $order_key);
$page->setPlaceholder("%HOMVALUE%", $order_mode);

$stmt = "SELECT * FROM addresses order by `".$order_key."` ".$order_mode;
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