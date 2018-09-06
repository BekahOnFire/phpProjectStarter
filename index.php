<?php
    /*
     * Written by Mind State Software Developing, Inc.
     * PHP Project Starter                 Version 1.0
     * September 2018
     */

    /*
     * Basic Index.php with login input fields.
     */

    foreach($_POST as $key=>$value) {  // Place post values in global variables.
        $value1=str_replace("'","`",$value);
        $_POST[$key]=str_replace("\"","``",$value1);
        // Uncomment, if you want all post/get variables to be appropriate vars.
        //$$key=$value1;
    }
    foreach($_GET as $key=>$value) {  // Place post values in global variables.
        $value1=str_replace("'","`",$value);
        $_GET[$key]=str_replace("\"","``",$value1);
        // Uncomment, if you want all post/get variables to be appropriate vars.
        //$$key=$value1;
    }

    $valid_id = "";
    $passwrd = "";
    $err_msg = "";
    if ( array_key_exists ('valid_id',$_POST) )
        $valid_id = $_POST['valid_id'];
    if ( array_key_exists ('passwrd',$_POST) )
        $passwrd = $_POST['passwrd'];
    if ( array_key_exists ('err_msg',$_GET) )
        $err_msg = $_GET['err_msg'];
    if ( array_key_exists ('err_msg',$_POST) )
        $err_msg .= $_POST['err_msg'];

// Page background image.  Change as needed.
?>
<div id="main" style="background-image: url('/images/dasDivSystem.gif');background-repeat: no-repeat;background-size:900px 600px;width: 940px; height: 600px;">

<form method="POST" action="/basicLogin.php">
        <p align="center"><font color="#FF0000"><b><?php echo "$err_msg"; ?></b></p>
<br> <br>
<p align="center">
<table border=0 cellpadding=0 cellspacing=0 >

 <tr><td><img border="0" src="images/m_clientid.jpg" title="Client ID"</td>
     <td><input type="text" name="valid_id" value="<?php echo $valid_id; ?>" size="12" maxsize="12"></td></tr>
     <tr><td><img border="0" src="images/m_psw.jpg" title="PSW"></td><td><input type="password" name="passwrd" value="<?php echo $passwrd; ?>" size="12" maxsize="12">
     </td></tr><tr><td colspan="2" align="center"><font color="#FF0000"><input type="submit" name="login_button" value="Login" >
        </td></tr>
</table>
</p>
</form>
</div>
