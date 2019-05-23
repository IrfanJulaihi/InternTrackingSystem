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
$_SESSION["SearchItem"]=$_POST['find'];
$colname_searching = "-1";
if (isset($_POST['find'])) {
$colname_searching =$_POST['find'] ;
}

mysql_select_db($database_Connection, $Connection);
$query_Recordset1 =$query_searching = sprintf("SELECT traineeinfo.ID,traineeinfo.Name,traineeinfo.IcNo,trainingapplication.Division,
trainingapplication.StartDate,
trainingapplication.EndDate,trainingapplication.TrainingStatus,trainingapplication.DateOfReceived,contactinfo.HandphoneNO,
contactinfo.EmailAddress,traineeinfo.Gender,traineeinfo.Religion 
FROM traineeinfo
    JOIN trainingapplication
        ON trainingapplication.ID = traineeinfo.ID
    JOIN contactinfo
        ON contactinfo.ID = trainingapplication.ID WHERE traineeinfo.Name LIKE %s ", GetSQLValueString("%" . $colname_searching. "%", "text"));
$Recordset1 = mysql_query($query_Recordset1, $Connection) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
if($totalRows_Recordset1==0){
	header("Location: NoRecordFound.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="TableCSSCode.css" rel="stylesheet" type="text/css" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search By Name</title>
</head>

<body>
<div align="center">
  <table width="263%" border="1" class="CSSTableGenerator">
  <tr>
    <td width="98"><div align="center">Entry No</div></td>
    <td width="120"><div align="center">Name</div></td>
    <td width="111"><div align="center">IC NO</div></td>
    <td width="130"><div align="center">Division</div></td>
    <td width="137"><div align="center">Start Date</div></td>
    <td width="134"><div align="center">End Date</div></td>
    <td width="165"><div align="center">Training Status</div></td>
    <td width="169"><div align="center">HP-NO</div></td>
    <td width="164"><div align="center">Email</div></td>
    <td width="127"><div align="center">Gender</div></td>
    <td width="432"><div align="center">Religion</div></td>
  </tr>
  <div align="center">
    <?php do { ?>
</div>
<tr>
      <td> <div align="center"><a href="../TraineeDetailInfo.php?ID=<?php echo $row_Recordset1['ID'];?>">PT<?php echo $row_Recordset1['ID']; ?>/<?php echo date("y",strtotime($row_Recordset1['DateOfReceived']));?></a></div></td>
      <td><div align="center"><?php echo $row_Recordset1['Name']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['IcNo']; ?></div></td>
      <td><div align="center"><?php echo $row_Recordset1['Division']; ?></div></td>
      <td><div align="center"><?php echo date("d-m-Y",strtotime($row_Recordset1['StartDate']));  ?></div></td>
      <td><div align="center"><?php echo date("d-m-Y",strtotime($row_Recordset1['EndDate']));  ?></div></td>
      <div align="center"><!--Code to change the color of status-->
      </div>
      <td><div align="center">
        <div align="center"  <?php if ($row_Recordset1['TrainingStatus']=='Completed'){?>
      style="color:green;"
      <?php }elseif($row_Recordset1['TrainingStatus']=='Dismissed'){?>
      style="color:red;"
       <?php }elseif($row_Recordset1['TrainingStatus']=='Current'){?>style="color:blue;"<?php }?> >
        <?php echo $row_Recordset1['TrainingStatus']; ?>
      </div>
  <div align="center">
    </div>
      </td>
  </div>
      <td><div align="center"><?php echo $row_Recordset1['HandphoneNO']; ?></div></td>
    <td><div align="center"><?php echo $row_Recordset1['EmailAddress']; ?></div></td>
    <td><div align="center"><?php echo $row_Recordset1['Gender']; ?></div></td>
    <td><div align="center"><?php echo $row_Recordset1['Religion']; ?></div></td>
    <div align="center">
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </tr>
    </ta>
    <?php
mysql_free_result($Recordset1);
?>
    
  
<p align="center"><a href="../AdminHomePage.php">
  <input  type="image" src="Image/backtohomepage.jpg" alt="Submit"  width="90" height="40" />
</a></p>
</body>
</html>