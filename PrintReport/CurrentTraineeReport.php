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
$Current="Current";
mysql_select_db($database_Connection, $Connection);
$query_Recordset1 = "SELECT traineeinfo.Name,traineeinfo.IcNo,bankinginfo.PTAllowNo,bankinginfo.BankName,bankinginfo.AccountNo,contactinfo.HandphoneNo,
contactinfo.EmailAddress,educationinfo.University,educationinfo.Qualification,trainingapplication.Division,
trainingapplication.StartDate,trainingapplication.EndDate,bankinginfo.Allowance
FROM traineeinfo
    JOIN trainingapplication
        ON traineeinfo.ID = trainingapplication.ID
    JOIN bankinginfo
        ON trainingapplication.ID = bankinginfo.ID
	Join contactinfo
	    On bankinginfo.ID=contactinfo.ID
        JOIN educationinfo
        on contactinfo.ID=educationinfo.ID WHERE trainingapplication.TrainingStatus= '".$Current."' ORDER BY StartDate ASC";
		//WHERE trainingapplication.TrainingStatus= '".$Current."' ORDER BY StartDate ASC
$Recordset1 = mysql_query($query_Recordset1, $Connection) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Current Trainee Report</title>
</head>

<body onload="window.print()">
<div align="center">
  <p>LIST OF CURRENT PRACTICAL TRAINEES (AS AT <strong><?php echo date("jS \of F Y")?></strong> )</p>

  <p>&nbsp;</p>
  <table width="1273" border="1" style="border-collapse:collapse;">
    <tr>
      <td width="30" rowspan="3"><div align="center"><strong>NO</strong>.</div></td>
      <td width="135" rowspan="3"><div align="center">
        <p><strong>*NAME</strong></p>
        <p><strong>*NATIONAL ID CARD NO</strong></p>
      </div></td>
      <td width="231" rowspan="3"><div align="center">
        <p><strong>*PT MONTHLY ALLW.NO.</strong></p>
        <p><strong>*BANK ACC. NO</strong></p>
        <p><strong>*HANDPHONE NO.</strong></p>
        <p><strong>*EMAIL</strong></p>
      </div></td>
      <td width="181" rowspan="3"><div align="center"><strong>QUALIFFICATION</strong></div></td>
      <td width="179" rowspan="3"><strong>UNIVERSITY/COLLEGE</strong></td>
      <td width="149" rowspan="3"><div align="center"><strong>DIV</strong></div></td>
      <td colspan="7"><div align="center">
        <p>DURATION</p>
      </div></td>
      <td width="166" rowspan="3"><div align="center">REMARK</div></td>
    </tr>
    <tr>
      <td colspan="3"><div align="center">DATE START</div></td>
      <td><div align="center"></div></td>
      <td colspan="3"><div align="center">DATE END</div></td>
    </tr>
    <tr>
      <td width="17"><div align="center">D</div></td>
      <td width="17"><div align="center">M</div></td>
      <td width="17"><div align="center">Y</div></td>
      <td width="12"><div align="center">to</div></td>
      <td width="17"><div align="center">D</div></td>
      <td width="17"><div align="center">M</div></td>
      <td width="17"><div align="center">Y</div></td>
    </tr>
    <?php $no=1;?>
    <?php do { ?>
    <tr>
      <td><div align="center"><?php echo $no++; ?></div></td>
      <td><div align="left"><?php echo $row_Recordset1['Name'];?>
        <br><?php echo $row_Recordset1['IcNo'];?></div></td>
      <td><div align="left"><strong><?php echo $row_Recordset1['PTAllowNo'];?></strong><br><?php echo $row_Recordset1['AccountNo'];?><br>
	  <?php echo $row_Recordset1['BankName'];?><br>H/P  <?php echo $row_Recordset1['HandphoneNo'];?> <br> Email-<br><?php echo $row_Recordset1['EmailAddress'];?></div></td>
      <td><div align="left"><?php echo $row_Recordset1['Qualification'];?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['University'];?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['Division']; ?></div></td>
      <td><div align="center"><?php echo date("d",strtotime($row_Recordset1['StartDate'])); ?></div></td>
      <td><div align="center"><?php echo date("m",strtotime($row_Recordset1['StartDate'])); ?></div></td>
      <td><div align="center"><?php echo date("y",strtotime($row_Recordset1['StartDate'])); ?></div></td>
      <td><div align="center">to</div></td>
      <td><?php echo date("d",strtotime($row_Recordset1['EndDate'])); ?></td>
      <td><div align="center"><?php echo date("m",strtotime($row_Recordset1['EndDate'])); ?></div></td>
      <td><div align="center"><?php echo date("y",strtotime($row_Recordset1['EndDate'])); ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['Allowance']; ?></div></td>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </tr>
  </table>
  <p>&nbsp;</p>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
