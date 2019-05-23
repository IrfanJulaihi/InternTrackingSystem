<?php require_once('../../Connections/Connection.php'); ?>
<?php
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
$DeleteFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $DeleteFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

mysql_select_db($database_Connection, $Connection);
$query_Recordset1 = "SELECT * FROM useraccount";
$Recordset1 = mysql_query($query_Recordset1, $Connection) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Member</title>
<link href="TableCSSCode.css" rel="stylesheet" type="text/css" >
</head>

<body>

  <div align="center">
    <table border="1" cellpadding="2" cellspacing="0"
class="CSSTableGenerator">
      <tr >
        <td width="24"><div align="center">No.</div></td>
        <td width="61"><div align="center">Username</div></td>
        <td width="60"><div align="center">Password</div></td>
        <td width="58"><div align="center">Name</div></td>
        <td width="77"><div align="center">AccessLevel</div></td>
        <td width="49"><div align="center">Date Register</div></td>
        <td colspan="2"><div align="center">Modify</div></td>
      </tr>
      <?php $no=1;?>
      <?php do { //dont change this?>
      <tr>
        <td><div align="center"><?php echo $no++;?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['Username']; ?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['Password']; ?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['Name']; ?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['AccessLevel']; ?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['DateRegister']; ?></div></td>
        <td width="46"><div align="center"><a href="EditAccountUser.php?ID=<?php echo $row_Recordset1['ID']; ?>"></a><a href="EditAccountUser.php?ID=<?php echo $row_Recordset1['ID']; ?>">
          <input type="submit" style="background-color:green;" name="button2" id="button2" value="Edit Account" onclick="" />
        </a></div></td>
        <td width="50"><div align="center"><a href="DeleteUser.php?ID=<?php echo $row_Recordset1['ID']; ?>" >
          <input type="submit" style="background-color:red;" name="button3" id="button3" value="Delete Account" onclick="return confirm('Are you sure you want to delete?');" />
        </a></div></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
      </table>
  </div>
  <div align="center">
    <p>&nbsp;</p>
    <p><a href="../AdminHomePage.php">
      <input  type="image" src="Image/backtohomepage.jpg" alt="Submit"  width="90" height="40" />
    </a></p>
  </div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
