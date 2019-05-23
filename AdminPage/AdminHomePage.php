<?php require_once('../Connections/Connection.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "Admin";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "StaffPage/StaffHomePage.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$maxRows_Recordset1 = 20;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_Connection, $Connection);
$query_Recordset1 = "SELECT traineeinfo.ID,traineeinfo.Name,traineeinfo.IcNo,trainingapplication.Division,
trainingapplication.StartDate,
trainingapplication.EndDate,trainingapplication.TrainingStatus,trainingapplication.DateOfReceived,contactinfo.HandphoneNO,
contactinfo.EmailAddress,traineeinfo.Gender,traineeinfo.Religion
FROM traineeinfo
    JOIN trainingapplication
        ON trainingapplication.ID = traineeinfo.ID
    JOIN contactinfo
        ON contactinfo.ID = trainingapplication.ID";
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Page</title>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script>
function changeAction(val){
    document.getElementById('SearchForm').setAttribute('action', val);

}
</script>
</head>
<link href="../TableCSSCode.css" rel="stylesheet" type="text/css" >
</head>
<body background="file:///C|/xampp/htdocs/InternProject/images/bg.gif">
<p><img src="../01_sedc_logo (1).gif" width="175" height="67" alt="SEDC LOGO" />
</p>
<span style="font-weight:normal;position: absolute; top: 12px; left: 1064px;color:#000000;letter-spacing:1pt;word-spacing:2pt;font-size:20px;text-align:left;font-family:arial black, sans-serif;line-height:1;"> You logged in as ,<span style="text-shadow:1px 1px 1px rgba(107,107,107,1);font-weight:normal;color:#2CC746;letter-spacing:1pt;word-spacing:2pt;font-size:25px;text-align:left;font-family:arial black, sans-serif;line-height:1;">ADMIN</span></span>
<p>&nbsp;</p>
<p style="text-shadow:1px 1px 1px rgba(255,240,105,1);font-weight:normal;color:#000000;background-color:#FFFCFC;letter-spacing:1pt;word-spacing:2pt;font-size:35px;text-align:center;font-family:arial black, sans-serif;line-height:1;margin:0px;padding:0px;">INTERN TRACKING SYSTEM</p>
<p>Welcome,<strong><?php echo $_SESSION['MM_Username']?></strong></p>
<div align="center">
  <ul id="MenuBar1" class="cssmenu" align="center">
    <li><a class="MenuBarItemSubmenu" href="#">Account Management</a>
      <ul>
        <li><a href="MenuBar/ViewMember.php">View User</a></li>
        <li><a href="MenuBar/RegisterNewUser.php">Register New User</a></li>
      </ul>
    </li>
    <li><a href="#" class="MenuBarItemSubmenu">Intern Management</a>
      <ul>
        <li><a href="RegisterNewIntern.php">Add New Intern</a></li>
      </ul>
    </li>
    <li><a class="MenuBarItemSubmenu" href="#">Print</a>
      <ul>
        <li><a href="../PrintReport/UpcomingTraineeReport.php">Print Upcoming Practical Trainees</a> </li>
        <li><a href="../PrintReport/CurrentTraineeReport.php">Print Current Practical Trainess</a></li>
        <li><a href="../PrintReport/PtRecord.php">Print PT Record</a></li>
      </ul>
    </li>
    <li><a href="<?php echo $logoutAction ?>">Logout</a></li>
  </ul>
</div>
<p>&nbsp;</p>
<p>&nbsp; </p>
<p><?php echo $totalRows_Recordset1?> records found.</p>
<span style="position: absolute; right: 800px; top: 294px;">
<form action="" name="SearchForm" id="SearchForm" method="Post">
<select name="SearchForm" onchange="changeAction(this.value)">
<option value="">Please select category to search:</option>
  <option value="Search/SearchByName.php">Search By Name</option>
  <option value="Search/SearchByIC.php">Search By IC</option>
  <option value="Search/SearchByDivision.php">Search By Division</option>
  <option value="Search/SearchByStatus.php">Search By Status</option>
</select> <input type="text" name="find"  ><input type="submit" value="Search" >
</form>
</span>
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
    
    <?php do { ?>
      <tr>
        <td><div align="center">
        <a href="TraineeDetailInfo.php?ID=<?php echo $row_Recordset1['ID'];?>">PT<?php echo $row_Recordset1['ID']; ?>/<?php echo date("y",strtotime($row_Recordset1['StartDate']));?></a></div></td>
        <td><div align="center"><?php echo $row_Recordset1['Name']; ?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['IcNo']; ?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['Division']; ?></div></td>
        
        <td><?php echo date("d-m-Y",strtotime($row_Recordset1['StartDate']));  ?></td>
        <td><div align="center"><?php echo date("d-m-Y",strtotime($row_Recordset1['EndDate']));  ?>	 </div></td>
        <!--Code to change the color of status-->
        <td><div align="center"  <?php if ($row_Recordset1['TrainingStatus']=='Completed'){?>
      style="color:green;"
      <?php }elseif($row_Recordset1['TrainingStatus']=='Dismissed'){?>
      style="color:red;"
       <?php }elseif($row_Recordset1['TrainingStatus']=='Current'){?>style="color:blue;"<?php }?> >
        <?php echo $row_Recordset1['TrainingStatus']; ?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['HandphoneNO']; ?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['EmailAddress']; ?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['Gender']; ?></div></td>
        <td><div align="center"><?php echo $row_Recordset1['Religion']; ?></div></td>
        <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </tr>
</table>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp; </p>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
  </script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
