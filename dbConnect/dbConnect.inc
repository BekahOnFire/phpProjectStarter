<?php
    /*
     * Written by Mind State Software Developing, Inc.
     * PHP Project Starter                 Version 1.0
     * September 2018
     */

/*
* These methods carry out the DB functions.
* Errors and Failures get logged to the Linux logs
*   and to a local log file.  The local log file is direct
*   rather than use the misc.inc libary call, because we
*   may not be sessioned, yet.
*/

class dbConnect
{
    static $link;
    static $dbptr;
    /*
     * Connect to the Database
     */
    public function dbConnectUp($dbhost,$dbname,$dbuser,$dbpass) {
        $link = mysql_connect($dbhost,$dbuser,$dbpass);
        if(!$link)
        {
            error_log("Could not connect: " . mysql_error(), 1, $_SERVER['REMOTE_ADDR']);
            file_put_contents($_SESSION["localLogFile"], 'Could not connect: ' . mysql_error() . "\n", FILE_APPEND | LOCK_EX);
            die('Could not connect: ' . mysql_error());
        }

        $dbptr = mysql_select_db($dbname, $link);
        if(!$dbptr)
        {
            error_log("Could not connect $dbname: " . mysql_error(), 1, "mxstert@mindstatedev.com");
            file_put_contents($_SESSION["localLogFile"], 'Could not connect $dbname: ' . mysql_error() . "\n", FILE_APPEND | LOCK_EX);
            die('Could not connect $dbname: ' . mysql_error());
        }
        return true;
    }
    /*
     * Execute Query
     */
    public function executeQuery($excep) {
        $sch_result = mysql_query($excep);
        if (!$sch_result) {
            $msg="Database search error.<br><br>Please contact the administrator.<br><br>$excep_rec<br><br>" . mysql_error() . "\n";
            error_log($msg, 1, "mxstert@mindstatedev.com");
            file_put_contents($_SESSION["localLogFile"], $msg, FILE_APPEND | LOCK_EX);
            return $msg;
        }
        return $sch_result;
    }
    /*
     * Return number of rows on result set.
     */
    public function queryResultsRowCount($resultSet) {
        return mysql_num_rows($resultSet);
    }
    /*
     * Return number of fields on result set.
     */
    public function queryResultsFieldCount($resultSet) {
        return mysql_num_fields($resultSet);
    }
    /*
     * Return a result Row set.
     */
    public function queryResultsRow($resultSet) {
        return mysql_fetch_array($resultSet);
    }
    /*
     * Return the error response
     */
    public function queryResultsError() {
        return mysql_error();
    }
    /*
     * Dis-Connect to the Database
     */
    public function dbclose() {
        mysql_close($dbptr);
        return true;
    }
}
