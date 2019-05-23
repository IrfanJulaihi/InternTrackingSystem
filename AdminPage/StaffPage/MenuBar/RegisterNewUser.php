<?php require_once('../../Connections/Connection.php'); ?>
<?php
session_start();
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="RegisterNewUser.php";
  $loginUsername = $_POST['Username'];
  $LoginRS__query = sprintf("SELECT Username FROM useraccount WHERE Username=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_Connection, $Connection);
  $LoginRS=mysql_query($LoginRS__query, $Connection) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
	$_SESSION['usrAvb'] = "Sorry,Username Available";
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}



if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	date_default_timezone_set("Asia/Kuala_Lumpur");
	 $date=date('Y-m-d H:i:s');
	 $staff='Staff';
  $insertSQL = sprintf("INSERT INTO useraccount (Name, Username, Password,AccessLevel,DateRegister) VALUES (%s, %s, %s,'$staff','$date')",
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Password'], "text"));

  mysql_select_db($database_Connection, $Connection);
  $Result1 = mysql_query($insertSQL, $Connection) or die(mysql_error());

  $insertGoTo = "ViewMember.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="TableCSSCodeRegister.css" rel="stylesheet" type="text/css" >
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="TableCSSCode2.css" rel="stylesheet" type="text/css" >
<meta charset="utf-8">
</head>

<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <div align="center">
    <p>&nbsp;</p>
    <table width="45%" border="1" class="CSSTableGenerator">
      <tr >
        <td scope="col" colspan="2"><div align="left">User Account Registration</div></th>
     
      </tr>
      <tr>
        <td width="85">Name:</td>
        <td width="209"><span id="sprytextfield1">
          <label for="Name"></label>
          <input type="text" name="Name" id="Name" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td>Username</td>
        <td><span id="sprytextfield2">
          <label for="Username"></label>
          <input type="text" name="Username" id="Username" />
        <span class="textfieldRequiredMsg">A value is required.</span><span style="color:red">
        <?php if(!empty($_SESSION['usrAvb'])) { echo $_SESSION['usrAvb'];unset($_SESSION['usrAvb']);} ?>
        </span></span>         </td>
      </tr>
      <tr>
        <td>Password:</td>
        <td><span id="sprytextfield3">
        <label for="Password"></label>
        <input type="password" name="Password" id="Password" />
        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Password Required (6 Characters).</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
      </tr>
      <tr>
        <td>Confirm Password:</td>
        <td><span id="spryconfirm1">
        <label for="PasswordConfirm"></label>
        <input type="Password" name="PasswordConfirm" id="PasswordConfirm" />
        <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">The Password don't match.</span></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="image" src="Image/Register.jpg" value="Register" width="100" height="30"></td>
      </tr>
    </table>
  </div>
  <input type="hidden" name="MM_insert" value="form1" />
</form>


<div align="center">
  <p>&nbsp;</p>
  <p><a href="../AdminHomePage.php">
    <input  type="image" src="Image/backtohomepage.jpg" alt="Submit"  width="90" height="40" />
  </a></p>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {minChars:6, maxChars:20});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "Password");
  </script>
</body>
</html>