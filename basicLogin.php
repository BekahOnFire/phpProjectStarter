<?php
    /*
     * Written by Mind State Software Developing, Inc.
     * PHP Project Starter                 Version 1.0
     * September 2018
     */

    include_once "dbConnect/dbConnect.inc";
    include_once "basic_misc.inc";

    foreach($_POST as $key=>$value) {  // Place the values in global variables.
        $value1=str_replace("'","`",$value);
        $_POST[$key]=str_replace("\"","``",$value1);
    }
    foreach($_GET as $key=>$value) {  // Place the values in global variables.
        $value1=str_replace("'","`",$value);
        $_GET[$key]=str_replace("\"","``",$value1);
    }

    if( array_key_exists ('logout',$_GET) && $_GET['logout'] == 'Log Out') {
        session_start(); // SESSION REGISTRATION ! ! ! ! !
        // header("Cache-control: no-cache");
        //echo "--isloggedin---> " . $_SESSION['isloggedin'];

        /*
           session_unregister is deprecated.  Uncomment for older PHP versions.
        */
        //if(isset($_SESSION["isloggedin"])) { session_unregister ("isloggedin"); }
        //if(isset($_SESSION["userid"])) { session_unregister ("userid"); }
        //if(isset($_SESSION["duplock"])) { session_unregister ("duplock"); }
        //if(isset($_SESSION["useraccess"])) { session_unregister ("useraccess"); }
        //if(isset($_SESSION["firstAttempt"])) { session_unregister ("firstAttempt"); }
        //if(isset($_SESSION["loginTrys"])) { session_unregister ("loginTrys"); }
        //if(isset($_SESSION["localLogFile"])) { session_unregister ("localLogFile"); }
        //if(isset($_SESSION["dbURL"])) { session_unregister ("dbURL"); }
        //if(isset($_SESSION["dbName"])) { session_unregister ("dbName"); }
        //if(isset($_SESSION["dbUser"])) { session_unregister ("dbUser"); }
        //if(isset($_SESSION["dbSecret"])) { session_unregister ("dbSecret"); }

        session_destroy (); // SESSION DESTROY ! ! ! ! !
        header("Location: /index.php?err_msg=Logged Out!"); /* Redirect */
        exit();
    }
    elseif( array_key_exists ('login_button',$_POST) && $_POST['login_button'] == 'Login') {

        if (getenv(HTTP_X_FORWARDED_FOR)) {       /* Grab the IP address for security */
           $ip = getenv(HTTP_X_FORWARDED_FOR);
        } else {
            $ip = getenv(REMOTE_ADDR);
        }

        $valid_id=$_POST['valid_id'];
        session_start(); // SESSION REGISTRATION ! ! ! ! !
        if (isset($_SESSION["firstAttempt"])) {
             $_SESSION["loginTrys"] = $_SESSION["loginTrys"] + 1;
        }
        else {
             /*
              session_register is deprecated.  Uncomment for older PHP versions.
             */
             // session_register ("firstAttempt");
             // session_register ("loginTrys");
             $_SESSION["firstAttempt"] = 1;
             $_SESSION["loginTrys"] = 1;
             $_SESSION["localLogFile"] = "localLog.log";
             $_SESSION["dbURL"] = "not found";
             $_SESSION["dbName"] = "not found";
             $_SESSION["dbUser"] = "not found";
             $_SESSION["dbSecret"] = "not found";
        }

        // Retrieve DB Stuff from byHisSide.php
        //     URL=192.168.0.131
        //     DATABASE=myDatabaseName
        //     USER=myUserName
        //     SECRET=mySecret
        $dbURL = "not found";
        $dbName = "not found";
        $dbUser = "not found";
        $dbSecret = "not found";
        $cfglines = file('byHisSide.php');
        foreach ($cfglines as $line_num => $line) {
            //echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
            if (strpos($line, 'URL=') !== false) {
                $hldAry = explode("=", $line);
                if ( count($hldAry) > 1 ) {
                    $dbURL = str_replace("\n", "", $hldAry[1]);
                    $_SESSION["dbURL"] = $dbURL;
                } else
                    $dbURL = "not set";
            }
            if (strpos($line, 'DATABASE=') !== false) {
                $hldAry = explode("=", $line);
                if ( count($hldAry) > 1 ) {
                    $dbName = str_replace("\n", "", $hldAry[1]);
                    $_SESSION["dbName"] = $dbName;
                } else
                    $dbName = "not set";
            }
            if (strpos($line, 'USER=') !== false) {
                $hldAry = explode("=", $line);
                if ( count($hldAry) > 1 ) {
                    $dbUser = str_replace("\n", "", $hldAry[1]);
                    $_SESSION["dbUser"] = $dbUser;
                } else
                    $dbUser = "not set";
            }
            if (strpos($line, 'SECRET=') !== false) {
                $hldAry = explode("=", $line);
                if ( count($hldAry) > 1 ) {
                    $dbSecret = str_replace("\n", "", $hldAry[1]);
                    $_SESSION["dbSecret"] = $dbSecret;
                } else
                    $dbSecret = "not set";
            }
        }

        // Connect to the database.
        $ptrDb = new dbConnect;
        $ptrDb->dbConnectUp($dbURL,$dbName,$dbUser,$dbSecret);

        $query = "select U.USER_NUMBER,USERNAME,PASSWD,APP_ACCESS,
                  MAXLOGINATTEMPTS, ADMIN_ABLE
                    from BASIC_USERS U, BASIC_USERS_CONFIG C
                    where USERNAME='" . $_POST['valid_id'] . "' and PASSWD='" . $_POST['passwrd'] . "'
                    and C.USER_NUMBER=U.USER_NUMBER ";
        $myResults = $ptrDb->executeQuery($query);
        if ($myResults) {
            if ( $ptrDb->queryResultsRowCount($myResults) < 1 ) {
                $err_msg = "Invalid Username and Password!<br>Remember, Username and Passwords are case sensitive.";
                localLogWriter($_POST['valid_id'], $err_msg);
                // Close the database.
                $ptrDb->dbclose();
                header("Location: /index.php?err_msg=" . $err_msg); /* Redirect */
                exit();
            }
        }
        else {
            $err_msg = "Invalid Username and Password.....";
            localLogWriter($_POST['valid_id'], $err_msg);
            // Close the database.
            $ptrDb->dbclose();
            header("Location: /index.php?err_msg=" . $err_msg); /* Redirect */
            exit();
        }

        $row = $ptrDb->queryResultsRow($myResults);
        $tnum=htmlspecialchars(stripslashes($row["USER_NUMBER"]));
        $maxloginattempts = htmlspecialchars(stripslashes($row["MAXLOGINATTEMPTS"]));

        if ( $_SESSION["loginTrys"] > $maxloginattempts ) {
            $err_msg = "<br><br><br><center><b>You have exceeded the maximum number of login attempts (". $maxloginattempts . ")<b></center><br><br><b>Restart your browser. " . $_SESSION["loginTrys"] . "</b>\n";
            echo $err_msg;
            localLogWriter($_POST['valid_id'], $err_msg);
            // Close the database.
            $ptrDb->dbclose();
            exit();
        }

        // Update the logging info.
        $insert = "update MOTL_USERS set LAST_LOGIN=now(),COUNT_LOGINS=COUNT_LOGINS+1,LAST_IP='$ip'
        where USERNAME='" . $_POST['valid_id'] . "' and PASSWD='" . $_POST['passwrd'] . "' ";
        $iresults = $ptrDb->executeQuery($insert);
        if (!$iresults) {
            $err_msg="Cannot update USERS table.<br><br>Please contact the administrator.";
            localLogWriter($_POST['valid_id'], $err_msg);
            // echo "<br>Error: " . $ptrDb->queryResultsError() . "<br>\n";
            // Close the database.
            $ptrDb->dbclose();
            header("Location: /index.php?err_msg=" . $err_msg); /* Redirect */
            exit();
        }

        // Debug Stuff
        // echo "Rows returned " . $ptrDb->queryResultsRowCount($myResults) . "<br>\n";
        // echo "Fields count " . $ptrDb->queryResultsFieldCount($myResults) . "<br>\n";
        // echo " TNUM " . $tnum . "<br>\n";
        // echo " MAX " . $maxloginattempts . "<br>\n";
        // echo " query " . $insert . "<br>\n";
        // echo " query results " . $iresults . "<br>\n";
        // exit();

        /*
          session_register is deprecated.  Uncomment for older PHP versions.
         */
        // session_register ("isloggedin");
        // session_register ("userid");
        $_SESSION["isloggedin"] = 1;
        $_SESSION["userid"] = $tnum;
        $_SESSION["duplock"] = 0;  // This variable is used to prevent folks from hitting the back button after inserts.
        $_SESSION["loginTrys"] = 0;
        $_SESSION["admin_able"] = "Y";

        // Close the database.
        $ptrDb->dbclose();

        $err_msg="";
        header("Location: /basicPHP.php"); /* Redirect */
    }
    else {
        header("Location: /index.php?err_msg=Illegal Request!"); /* Redirect */
        localLogWriter($_SESSION["userid"], $errorMsg);
        exit();
    }
?>
