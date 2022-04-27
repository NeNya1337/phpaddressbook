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

//create page type insert
$page = new Page("insert");
$page->setPlaceholder("%METHOD%","edit");

//check the request
if(isset($_REQUEST["id"])){
    $page->setPlaceholder("%ID%",$_REQUEST["id"]);

    //get the data of the record getting edited and fill the input fields
    $result = $page->getDatabase()->dbFetch($_REQUEST["id"]);
    foreach($result as $entry){
        $page->setPlaceholder("%NAME%",$entry["name"]);
        $page->setPlaceholder("%CITY%",$entry["city"]);
    }
    echo $page->getHTML();
} else {
    //give an error, e.g. if you entered this page without passing a form
    echo "Oops, something went wrong! Navigate back or click <a href='index.php'>here</a>.";
}