<?php
    /*
     * Written by Mind State Software Developing, Inc.
     * PHP Project Starter                 Version 1.0
     * September 2018
     */

//
// Validate the user session.
//
function validate_user_session()
{
    session_start(); // SESSION REGISTRATION ! ! ! ! !
    // Uncomment for no cache.
    // header("Cache-control: private");
    if (isset($_SESSION['isloggedin'])) {
        //$_SESSION["isloggedin"] ++;
        return 0;
    }
    else {
       return -1;
    }
}

//
// Write to the local log.
//
function localLogWriter($userid, $errorMsg)
{
    if (getenv(HTTP_X_FORWARDED_FOR)) {       /* Grab the IP address for security */
       $ip = getenv(HTTP_X_FORWARDED_FOR);
    } else {
        $ip = getenv(REMOTE_ADDR);
    }

    $msgLine = $ip . ";;" . $userid . ";;" . $errorMsg . "\n";

    // Session set at login, $_SESSION["localLogFile"]
    file_put_contents($_SESSION["localLogFile"], $msgLine, FILE_APPEND | LOCK_EX);
}

//
// Write to the database log.
// Requesting function needs to open connection to the DB.
//
// Trans_number is blank for now. Use as desired.
//
function databaseLogWriter($ptrToDb, $userid, $errorMsg)
{
    $query = "insert into BASIC_LOG (TRANS_NUMBER,ENTRY_DATE,USERNAME,LOG_ENTRY) values (null, now(), '" . $userid . "','" . $errorMsg . "')";
    $myResults = $ptrToDb->executeQuery($query);
    return $myResults;
}
