<?php
    /*
     * Written by Mind State Software Developing, Inc.
     * PHP Project Starter                 Version 1.0
     * September 2018
     */

    //     Coming soon! ! ! ! !
    //
    // Database access encrypt/de-encrypt
    //

    $filename = "byHisSide.php";
    $displayVerse = "<br>"
        . "<br>For GOD so loved the worlded, that He gave His only Begotton Son, that whosoever should believe in Him should not perish, but have everlasting life. John 3:16<br>"
        . "<br>\n";

    // Encrypt a default for new file creation.
    $encryptSeed = "theLambHasOvercome";
    $encryptURL = "url not set";
    $encryptDATABASE = "databse name not set";
    $encryptUSER = "user not set";
    $encryptSECRET = "secret not set";
    $displayContent = "\n// --------------------------------------------------------\n"
        . "// URL=$encryptURL\n"
        . "// DATABASE=$encryptDATABASE\n"
        . "// USER=$encryptUSER\n"
        . "// SECRET=$encryptSECRET\n"
        . "// --------------------------------------------------------\n";

// php darkChocolate.php runas=[view,update] dburl=[ip or server name] dbname=[name] dbuser=[user id] dbpsswd=[password]
// php darkChocolate.php runas=view dburl=192.168.111.222 dbname=ONTRIAL dbuser=user dbpsswd=pass
if ( $argc > 1 ) { // At least 1 argument.
    echo "<br>Starting " . $argv[0] . " with $argc parameters.<br>\n";

    // If file is missing, create it.
    if ( !file_exists($filename) ) {
        file_put_contents($filename,$displayVerse . "\n" . '<?php' . "\n" . $displayContent . "\n?>");
    }

    // Parse command-line variables.
    list($key, $val) = explode('=', $argv[1]);
    $$key=$val;
    if ( isset($runas) && $runas == "view" ) {
        // Open the file for viewing.
        $linesAry = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $showOn = "OFF";
        foreach ($linesAry as $line_num => $line) {
//echo "XXXXXXXXX $showOn " . strpos($line,'---------')  . "  $line<br>\n";
            if ( strpos($line,'---------'.'---------') && $showOn === "OFF" )
                $showOn = "ON";
            elseif ( strpos($line,'---------'.'---------') && $showOn === "ON" )
                $showOn = "OFF";
            if ( $showOn === "ON" )
                echo $line_num . " ($showOn) " . $line . "<br>\n";
        }
    }
    elseif ( $argc > 5 ) {
        for ( $loop = 2; $loop < $argc; $loop++) {
            list($key, $val) = explode('=', $argv[$loop]);
            echo "List $loop: $key value $val<br>\n";
            $$key=$val;
            if ( isset($runas) && isset($dburl) && isset($dbname) && isset($dbuser) && isset($dbpsswd) ){
                echo "<br>Type $runas<br><br>";
            }
            else {
                echo "<br><br>Stopping short, again.<br><br>";
            }
        }
    }
    else {
        echo "<br><br>Stopping short<br><br>";
    }
}
?>
