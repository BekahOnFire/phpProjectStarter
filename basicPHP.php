<?php
    /*
     * Written by Mind State Software Developing, Inc.
     * PHP Project Starter                 Version 1.0
     * September 2018
     */

    /*
     * Basic web page layout with menu and div background.
     * Demonstrates logging to local file.
     */

    include_once "htmlClass/webDisplay.inc";
    include_once "dbConnect/dbConnect.inc";
    include_once "basic_misc.inc";

    foreach($_POST as $key=>$value) {  // Place post values in global variables.
        $value1=str_replace("'","`",$value);
        $_POST[$key]=str_replace("\"","``",$value1);
        $$key=$value1;
    }
    foreach($_GET as $key=>$value) {  // Place post values in global variables.
        $value1=str_replace("'","`",$value);
        $_GET[$key]=str_replace("\"","``",$value1);
        $$key=$value1;
    }

    // * * * * * * * * * * * * * * * * * * *
    // Security Check
    // * * * * * * * * * * * * * * * * * * *
    if ( validate_user_session() != 0 ) {
        header("Location: /index.php"); /* Redirect */
        exit;
    }

    $ptrWeb = new webDisplay;
 
    echo $ptrWeb->showHeader("Policy Review Testing");
    echo $ptrWeb->displayCssLink("basic.css");
    echo $ptrWeb->displayJsScript("basic.js");
    echo $ptrWeb->displayHdrTagClose();

    $onLoadValue = "";

    echo $ptrWeb->displayBodyTag($onLoadValue);
    echo $ptrWeb->displayLogo("");
    echo $ptrWeb->displaySideBar();

    // Logging the page hit.
    localLogWriter($_SESSION["userid"], "basicPHP page connect");

    // Print main div and Form.
    echo $ptrWeb->displayTypicalPage("Policy Review Configuration","siteInputForm","basicPHP.php");

    // Get the session values.
    $dbURL = $_SESSION["dbURL"];
    $dbName = $_SESSION["dbName"];
    $dbUser = $_SESSION["dbUser"];
    $dbSecret = $_SESSION["dbSecret"];

    $ptrDb = new dbConnect;
    $ptrDb->dbConnectUp($dbURL,$dbName,$dbUser,$dbSecret);
    $query = "select USERNAME,LAST_LOGIN,COUNT_LOGINS from BASIC_USERS";
    $myResults = $ptrDb->executeQuery($query);
    if ($myResults) {
        echo "Rows returned " . $ptrDb->queryResultsRowCount($myResults) . "<br>\n";
        echo "Fields count " . $ptrDb->queryResultsFieldCount($myResults) . "<br>\n";
        for ($loop=0; $loop< $ptrDb->queryResultsRowCount($myResults); $loop++) {
            $row = $ptrDb->queryResultsRow($myResults);
            if (!$row) {
                $msg="Query error BASIC_USERS :<br><br>" . $ptrDb->queryResultsError() . "<br><br>Please contact the administrator.";
                echo "<br>$msg<br>\n";
            }
            echo "<br>" . htmlspecialchars(stripslashes($row["USERNAME"]));
            echo " &nbsp;&nbsp;" . htmlspecialchars(stripslashes($row["LAST_LOGIN"]));
            echo "<br>\n";
        }
    }
    else
        echo "<br><br>Failed<br><br>\n";

    // Close the database connection.
    $ptrDb->dbclose();

    // Print ending main div.
    echo "</div>";

    // Close Page.
    echo $ptrWeb->displayHTMLPageClose();

    // Page footer.
    echo $ptrWeb->displayHTMLPageFooter();
