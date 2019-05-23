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

$colname_Recordset1 = "-1";
if (isset($_GET['ID'])) {
  $colname_Recordset1 = $_GET['ID'];
}
mysql_select_db($database_Connection, $Connection);
$query_Recordset1 = sprintf("SELECT * FROM useraccount WHERE ID = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $Connection) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="EditAccountUser.php";
  $loginUsername = $_POST['ChgUser'];
  $LoginRS__query = sprintf("SELECT Username FROM useraccount WHERE Username=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_Connection, $Connection);
  $LoginRS=mysql_query($LoginRS__query, $Connection) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  
  if($row_Recordset1['Username']==$_POST['ChgUser']){
	if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE useraccount SET Name=%s, Username=%s, Password=%s WHERE ID=%s",
                       GetSQLValueString($_POST['ChgName'], "text"),
                       GetSQLValueString($_POST['ChgUser'], "text"),
                       GetSQLValueString($_POST['ChgPass'], "text"),
                       GetSQLValueString($_POST['ID'], "int"));

  mysql_select_db($database_Connection, $Connection);
  $Result1 = mysql_query($updateSQL, $Connection) or die(mysql_error());

  $updateGoTo = "ViewMember.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}  
  }else if($row_Recordset1['Username']!=$_POST['ChgUser']){
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
	
    $_SESSION['usrAvb'] = "Sorry,Username Available";
	
	header ("Location: $MM_dupKeyRedirect");
    return 0;
  }else{
	 if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE useraccount SET Name=%s, Username=%s, Password=%s WHERE ID=%s",
                       GetSQLValueString($_POST['ChgName'], "text"),
                       GetSQLValueString($_POST['ChgUser'], "text"),
                       GetSQLValueString($_POST['ChgPass'], "text"),
                       GetSQLValueString($_POST['ID'], "int"));

  mysql_select_db($database_Connection, $Connection);
  $Result1 = mysql_query($updateSQL, $Connection) or die(mysql_error());

  $updateGoTo = "ViewMember.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}   
	  
  }
  
}}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link href="TableCSSCode3.css" rel="stylesheet" type="text/css" >
</head>
</head>

<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <div align="center">
    <table width="45%" border="1" class="CSSTableGenerator">
      <tr >
        <td scope="col" colspan="2"><div align="left">Edit Account User</div>
          </th></td>
      </tr>
      <tr>
        <td width="113">Change Name:</td>
        <td width="191"><span id="sprytextfield1">
          <label for="Name2"></label>
          <span id="sprytextfield4">
          <label for="ChgName"></label>
          <input name="ChgName" type="text" id="ChgName" value="<?php echo $row_Recordset1['Name']; ?>" />
        <span class="textfieldRequiredMsg">A value is required.</span></span>        </span></td>
      </tr>
      <tr>
        <td>Change Username:        </td>
        <td><span id="sprytextfield2">
          <label for="Username"></label>
          <span id="sprytextfield5">
          <label for="ChgUser"></label>
          <span class="textfieldRequiredMsg">A value is required.</span></span>          <span style="color:red">
          <input name="ChgUser" type="text" id="ChgUser" value="<?php echo $row_Recordset1['Username']; ?>" />
          <?php if(!empty($_SESSION['usrAvb'])) { echo $_SESSION['usrAvb'];unset($_SESSION['usrAvb']);} ?>
          </span></span></td>
      </tr>
      <tr>
        <td>Change Password:</td>
        <td><span id="sprytextfield3">
          <label for="Password"></label>
          <span id="sprytextfield6">
          <label for="ChgPass"></label>
          <input type="password" name="ChgPass" id="ChgPass" />
          <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span></span>        </span></td>
      </tr>
      <tr>
        <td>Confirm Password:</td>
        <td><span id="spryconfirm1">
          <label for="PasswordConfirm"></label>
          <span id="spryconfirm2">
          <label for="CfrmPass"></label>
          <input type="password" name="CfrmPass" id="CfrmPass" />
        <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">The values don't match.</span></span>        </span></td>
      </tr>
      <tr>
      
  
        <td colspan="2"><div align="center">
          <input type="submit" value="Update Account" />
        </div></td>
      </tr>
    </table>
    <p><input name="ID" type="hidden" 
    value="<?php echo $row_Recordset1['ID']; ?>"/></p>
  </div>
  <input type="hidden" name="MM_insert" value="form1" />
  <input type="hidden" name="MM_update" value="form1" />
</form>
<div align="center"><a href="../AdminHomePage.php">
  <input type="submit" value="Back To View Member" />
  </a>
  </div>
<script type="text/javascript">
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {minChars:6});
var spryconfirm2 = new Spry.Widget.ValidationConfirm("spryconfirm2", "ChgPass");
  </script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
