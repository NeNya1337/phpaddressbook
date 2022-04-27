<?php
/**
 * This is the index page.
 *
 * It shows the list of the address book and provides access to the CRUD functions for the records.
 * It also handles the requests if any.
 *
 * @author Mark Lösche
 */

//include the classes
require_once("lib/classes/db.inc.php");
require_once("lib/classes/page.inc.php");

//create page type overview
$page = new Page("overview");

//handle the request for insert and update
if(isset($_REQUEST["method"]) && isset($_REQUEST["name"]) && isset($_REQUEST["city"])){
    switch($_REQUEST["method"]){
        case "edit":
            if(isset($_REQUEST["id"])){
                $page->getDatabase()->editAddress($_REQUEST);
            }
            break;
        case "insert":
            $page->getDatabase()->insertAddress($_REQUEST);
            break;
        default: break;
    }
}

//handle the request for delete
if(isset($_REQUEST["instant"]) && isset($_REQUEST["id"])){
    $page->getDatabase()->deleteAddress($_REQUEST["id"]);
}

//set the table
$page->setPlaceholder("%TABLE%", $page->load("table"));

$order_key = "id";
$order_mode = "asc";

//handle the changed sorting request
if(isset($_REQUEST["order_key"]) && isset($_REQUEST["order_mode"])){
    $order_key = $_REQUEST["order_key"];
    $order_mode = $_REQUEST["order_mode"];
}

$page->setPlaceholder("%HOKVALUE%", $order_key);
$page->setPlaceholder("%HOMVALUE%", $order_mode);

//get the data
$result = $page->getDatabase()->dbFetch(null, $order_key, $order_mode);

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