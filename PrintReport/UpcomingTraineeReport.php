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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_Connection, $Connection);
$query_Recordset1 = "SELECT * FROM traineeinfo";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $Connection) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

mysql_select_db($database_Connection, $Connection);
$Upcoming="UpComing";
$query_Recordset1 = "SELECT traineeinfo.Name,educationinfo.Qualification,educationinfo.University,trainingapplication.Division,
trainingapplication.StartDate,trainingapplication.TrainingStatus,
trainingapplication.EndDate,bankinginfo.Allowance
FROM educationinfo
    JOIN trainingapplication
        ON educationinfo.ID = trainingapplication.ID
    JOIN bankinginfo
        ON trainingapplication.ID = bankinginfo.ID
	Join traineeinfo
	    On bankinginfo.ID=traineeinfo.ID WHERE trainingapplication.TrainingStatus= '".$Upcoming."' ORDER BY StartDate ASC";
$Recordset1 = mysql_query($query_Recordset1, $Connection) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
//Day date to output in table
$DayDate=strtotime($row_Recordset1['StartDate']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upcoming Trainee Report</title>
</head>

<body onload="window.print()">
<div align="center">
  <div align="center">
   
    <p>UPCOMING PRACTICAL ATTACHMENT TRAINING TRACK RECORD</p>
    <p>AS AT <?php echo date("jS \of F Y")?></p>
    <table width="1063" border="1" style="border-collapse:collapse;">
      <tr>
        <td width="28" rowspan="3"><div align="center" >NO.</div></td>
        <td width="129" rowspan="3"><div align="center">NAME</div></td>
        <td width="164" rowspan="3"><div align="center">QUALIFICATION</div></td>
        <td width="166" rowspan="3"><div align="center">UNIVERSITY/COLLEGE</div></td>
        <td width="137" rowspan="3"><div align="center">DIVISION</div></td>
        <td colspan="7"><div align="center">
          <p>DURATION</p>
        </div></td>
        <td width="289" rowspan="3"><div align="center">Remark</div></td>
      </tr>
      <tr>
        <td colspan="3"><div align="center">DATE START</div></td>
        <td><div align="center"></div></td>
        <td colspan="3"><div align="center">DATE END</div></td>
      </tr>
      <tr>
        <td width="21"><div align="center">D</div></td>
        <td width="20"><div align="center">M</div></td>
        <td width="19"><div align="center">Y</div></td>
        <td width="12"><div align="center">to</div></td>
        <td width="20"><div align="center">D</div></td>
        <td width="21"><div align="center">M</div></td>
        <td width="22"><div align="center">Y</div></td>
      </tr>
      <?php $no=1;?>
      <?php do { ?>
      <tr>
        
          <td><div align="center"><?php echo $no++; ?></div></td>
          <td><div align="center"><?php echo $row_Recordset1['Name']; ?></div></td>
          <td><div align="center"><?php echo $row_Recordset1['Qualification']; ?></div></td>
          <td><div align="center"><?php echo $row_Recordset1['University']; ?></div></td>
          <td><div align="center"><?php echo $row_Recordset1['Division']; ?></div></td>

          <td><div align="center"><?php echo date("d",strtotime($row_Recordset1['StartDate'])); ?>  </div></td>
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
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
