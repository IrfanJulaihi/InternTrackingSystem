<?php require_once('../Connections/Connection.php'); ?>
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

mysql_select_db($database_Connection, $Connection);
$query_Recordset1 = "SELECT * FROM traineeinfo";
$Recordset1 = mysql_query($query_Recordset1, $Connection) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = "-1";
if (isset($_GET['ID'])) {
  $totalRows_Recordset1 = $_GET['ID'];
}
$colname_Recordset1 = "-1";
if (isset($_GET['ID'])) {
  $colname_Recordset1 = $_GET['ID'];
}
mysql_select_db($database_Connection, $Connection);
$query_Recordset1 = sprintf("SELECT * FROM traineeinfo WHERE ID = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $Connection) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['ID'])) {
  $colname_Recordset2 = $_GET['ID'];
}
mysql_select_db($database_Connection, $Connection);
$query_Recordset2 = sprintf("SELECT * FROM contactinfo WHERE ID = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $Connection) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_Recordset3 = "-1";
if (isset($_GET['ID'])) {
  $colname_Recordset3 = $_GET['ID'];
}
mysql_select_db($database_Connection, $Connection);
$query_Recordset3 = sprintf("SELECT * FROM bankinginfo WHERE ID = %s", GetSQLValueString($colname_Recordset3, "int"));
$Recordset3 = mysql_query($query_Recordset3, $Connection) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$colname_Recordset4 = "-1";
if (isset($_GET['ID'])) {
  $colname_Recordset4 = $_GET['ID'];
}
mysql_select_db($database_Connection, $Connection);
$query_Recordset4 = sprintf("SELECT * FROM trainingapplication WHERE ID = %s", GetSQLValueString($colname_Recordset4, "int"));
$Recordset4 = mysql_query($query_Recordset4, $Connection) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

$colname_Recordset5 = "-1";
if (isset($_GET['ID'])) {
  $colname_Recordset5 = $_GET['ID'];
}
mysql_select_db($database_Connection, $Connection);
$query_Recordset5 = sprintf("SELECT * FROM educationinfo WHERE ID = %s", GetSQLValueString($colname_Recordset5, "int"));
$Recordset5 = mysql_query($query_Recordset5, $Connection) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Profile Of Intern</title>
<link href="TableCSSCodeTraineeDetail.css" rel="stylesheet" type="text/css" >
</head>

<body>
<div align="center">
 
  <p style="color: rgb(0, 0, 0);
font-size: 50px;
font-family:arial;
text-shadow: rgb(71, 71, 71) 3px 2px 2px;">Donation of <?php echo $row_Recordset1['Name']; ?></p>
  <table width="324" border="1" class="CSSTableGenerator">
    <tr>
      <td colspan="2">PERSONAL INFO</td>
      
    </tr>
    <tr>
      <td>ENTRY NO:</td>
      <td><p style="color:red;"><strong>PT<?php echo $row_Recordset1['ID']; ?></strong><strong></strong></p></td>
    </tr>
    <tr>
      <td width="144">NAME:</td>
      <td width="164"><strong><?php echo $row_Recordset1['Name']; ?></strong></td>
    </tr>
    <tr>
      <td>IC NO:</td>
      <td><?php echo $row_Recordset1['IcNo']; ?></td>
    </tr>
    <tr>
      <td>HOME ADDRESS:</td>
      <td><?php echo $row_Recordset1['HomeAddress']; ?></td>
    </tr>
    <tr>
      <td>CITY:</td>
      <td><?php echo $row_Recordset1['City']; ?></td>
    </tr>
    <tr>
      <td>STATE:</td>
      <td><?php echo $row_Recordset1['State']; ?></td>
    </tr>
    <tr>
      <td>DATE OF BIRTH:</td>
      <td><?php echo date("d-m-Y",strtotime($row_Recordset1['DateOfBirth'])); ?></td>
    </tr>
    <tr>
      <td>GENDER:</td>
      <td><?php echo $row_Recordset1['Gender']; ?></td>
    </tr>
    <tr>
      <td>RACE:</td>
      <td><?php echo $row_Recordset1['Race']; ?></td>
    </tr>
    <tr>
      <td>RELIGION:</td>
      <td><?php echo $row_Recordset1['Religion']; ?></td>
    </tr>
    <tr>
      <td colspan="2">CONTACT INFORMATION:</td>
      
    </tr>
    <tr>
      <td>HANDPHONE NO:</td>
      <td><?php echo $row_Recordset2['HandphoneNO']; ?></td>
    </tr>
    <tr>
      <td>HOME PHONE NO:</td>
      <td><?php echo $row_Recordset2['HomePhoneNo']; ?></td>
    </tr>
    <tr>
      <td>EMAIL ADDRESS:</td>
      <td><?php echo $row_Recordset2['EmailAddress']; ?></td>
    </tr>
    <tr>
      <td>MAILING ADDRESS:</td>
      <td><?php echo $row_Recordset2['MailingAddress']; ?></td>
    </tr>
    <tr>
      <td colspan="2">BANKING INFORMATION:</td>
      
    </tr>
    <tr>
      <td>ALLOWANCE:</td>
      <td><?php echo $row_Recordset3['Allowance']; ?></td>
    </tr>
    <tr>
      <td>BANK NAME:</td>
      <td><?php echo $row_Recordset3['BankName']; ?></td>
    </tr>
    <tr>
      <td>ACCOUNT NO:</td>
      <td><?php echo $row_Recordset3['AccountNo']; ?></td>
    </tr>
    <tr>
      <td>PT ALLOWANCE NO:</td>
      <td><?php echo $row_Recordset3['PTAllowNo']; ?></td>
    </tr>
    <tr>
      <td colspan="2"><span  red">TRAINING APPLICATION:</span></td>
      
    </tr>
    <tr>
      <td>DATE OF APPLICATION LETTER</td>
      <td><?php echo date("d-m-Y",strtotime($row_Recordset4['DateOfApplication'])); ?></td>
    </tr>
    <tr>
      <td>DATE RECEIVED:</td>
      <td><?php echo date("d-m-Y",strtotime($row_Recordset4['DateOfReceived'])); ?></td>
    </tr>
    <tr>
      <td>START DATE:</td>
      <td><?php echo date("d-m-Y",strtotime($row_Recordset4['StartDate'])); ?></td>
    </tr>
    <tr>
      <td>END DATE:</td>
      <td><?php echo date("d-m-Y",strtotime($row_Recordset4['EndDate'])); ?></td>
    </tr>
    <tr>
      <td>DURATION:</td>
      <td><?php echo $row_Recordset4['Duration']; ?> days</td>
    </tr>
    <tr>
      <td>DIVISION:</td>
      <td><?php echo $row_Recordset4['Division']; ?></td>
    </tr>
    <tr>
      <td>DIVISION ACCEPT:</td>
      <td><?php echo $row_Recordset4['DivisionAccept']; ?></td>
    </tr>
    <tr>
      <td>STUDENT ACCEPT:</td>
      <td><?php echo $row_Recordset4['StudentAccept']; ?></td>
    </tr>
    <tr>
      <td>TRAINING STATUS:</td>
      <td><?php echo $row_Recordset4['TrainingStatus']; ?></td>
    </tr>
    <tr>
      <td colspan="2"><span >EDUCATION BACKGROUND</span></td>
      
    </tr>
    <tr>
      <td>UNIVERSITY:</td>
      <td><?php echo $row_Recordset5['University']; ?></td>
    </tr>
    <tr>
      <td>QUALIFICATION:</td>
      <td><?php echo $row_Recordset5['Qualification']; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><a href="Editinterninfo.php?ID=<?php echo $row_Recordset1['ID'];?>"><input type="image" src="Image/EditButton.jpg" alt="Submit" width="80" height="48"></a></td>
    </tr>
  </table>
</div>
<p align="center"><a href="AdminHomePage.php">
  <input  type="image" src="Image/backtohomepage.jpg" alt="Submit"  width="90" height="40" />
</a></p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);

mysql_free_result($Recordset5);
?>
