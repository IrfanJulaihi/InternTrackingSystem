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
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_Connection, $Connection);
$query_Recordset1 = "SELECT traineeinfo.ID,traineeinfo.Name,trainingapplication.DateOfApplication,
trainingapplication.DateOfReceived,
educationinfo.University,educationinfo.Qualification,
trainingapplication.StartDate,trainingapplication.EndDate,trainingapplication.Duration,
trainingapplication.Division,
trainingapplication.DivisionAccept
FROM traineeinfo
    JOIN trainingapplication
        ON traineeinfo.ID = trainingapplication.ID
    JOIN bankinginfo
        ON trainingapplication.ID = bankinginfo.ID
	Join educationinfo
	    On bankinginfo.ID=educationinfo.ID";
$Recordset1 = mysql_query($query_Recordset1, $Connection) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print PT Record</title>
</head>
<body onload="window.print()">
<div align="center">
  <table width="200" border="1">
    <tr>
      <td><div align="center">PT RECORD 1</div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="1693" border="1" style="border-collapse:collapse;">
    <tr>
      <td width="126" rowspan="2"><p align="center" >&nbsp;</p>
        <p align="center">ENTRY</p>
      <p align="center">&nbsp;</p></td>
      <td width="178" rowspan="2"><div align="center">APPLICANTS/STUDENTS</div></td>
      <td width="59" rowspan="2"><div align="center">LETTER OF DATE</div></td>
      <td width="63" rowspan="2"><div align="center">DATE RECORD</div></td>
      <td width="149" rowspan="2"><div align="center">HIGHER LEARNING INSTITUTION</div></td>
      <td width="164" rowspan="2"><p align="center">DISCIPLINE/</p>
      <p align="center">STUDIES</p></td>
      <td colspan="3"><div align="center">TRAINING PERIOD</div></td>
      <td colspan="3"><div align="center">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>SOURCING</p>
      </div>        <p align="center">&nbsp;</p>        <p align="center">&nbsp;</p></td>
      <td width="146"><div align="center">If Y(1)</div></td>
      <td width="158"><p align="center">Attacht</p></td>
    </tr>
    <tr>
      <td width="80"><p align="center">START d/m/y</p></td>
      <td width="142"><div align="center">END d/m/y</div></td>
      <td width="142"><div align="center">M/W</div></td>
      <td width="48"><div align="center">DIV/OFF.</div></td>
      <td width="69"><p align="center">Y(1)</p>
      <p align="center">(date)</p></td>
      <td width="81"><p align="center">R</p>
      <p align="center">(date)</p></td>
      <td><p>Letter(date)</p>
        <ul>
          <li>Faculty</li>
          <li>Students</li>
        </ul>
        <p align="right">N/Y(2)</p></td>
      <td><ul>
        <li>Div/Unit</li>
        <li>Office</li>
      </ul></td>
    </tr>
      <?php do { ?>
    <tr>
    
        <td><div align="center">PT<?php echo $row_Recordset1['ID']?>/<?php echo date("y",strtotime($row_Recordset1['StartDate'])); ?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['Name']?></div></td>
        <td><div align="center"><?php echo date("d-m-y",strtotime($row_Recordset1['DateOfApplication']));?></div></td>
        <td><div align="center"><?php echo date("d-m-y",strtotime($row_Recordset1	['DateOfReceived']));?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['University']?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['Qualification']?></div></td>
        <td><div align="center"><?php echo date("d-m-y",strtotime($row_Recordset1['StartDate']));?></div></td>
        <td><div align="center"><?php echo date("d-m-y",strtotime($row_Recordset1['EndDate']));?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['Duration'] ?> days</div></td>
        <td><div align="center"><?php echo $row_Recordset1['Division']?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['DivisionAccept']?></div></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
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
