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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE bankinginfo SET Allowance=%s, BankName=%s, AccountNo=%s, 	PTAllowNo=%s WHERE  ID=%s",
                       GetSQLValueString($_POST['Allowance'], "text"),
                       GetSQLValueString($_POST['BankName'], "text"),
                       GetSQLValueString($_POST['AccountNo'], "text"),
					   GetSQLValueString($_POST['PTAllowNo'], "text"),
                       GetSQLValueString($_POST['ID'], "int"));

  mysql_select_db($database_Connection, $Connection);
  $Result1 = mysql_query($updateSQL, $Connection) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE contactinfo SET HandphoneNO=%s, HomePhoneNo=%s, EmailAddress=%s, MailingAddress=%s WHERE ID=%s",
                       GetSQLValueString($_POST['HpNo'], "text"),
                       GetSQLValueString($_POST['HomePhoneNo'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['MailingAddress'], "text"),
                       GetSQLValueString($_POST['ID'], "int"));

  mysql_select_db($database_Connection, $Connection);
  $Result1 = mysql_query($updateSQL, $Connection) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE educationinfo SET University=%s, Qualification=%s WHERE ID=%s",
                       GetSQLValueString($_POST['University'], "text"),
                       GetSQLValueString($_POST['Qualification'], "text"),
                       GetSQLValueString($_POST['ID'], "int"));

  mysql_select_db($database_Connection, $Connection);
  $Result1 = mysql_query($updateSQL, $Connection) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE traineeinfo SET Name=%s, IcNo=%s, HomeAddress=%s, City=%s, `State`=%s, DateOfBirth=%s, Gender=%s, Race=%s, Religion=%s WHERE ID=%s",
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['ICNO'], "text"),
                       GetSQLValueString($_POST['HomeAddress'], "text"),
                       GetSQLValueString($_POST['City'], "text"),
                       GetSQLValueString($_POST['State'], "text"),
                       GetSQLValueString($_POST['DateOfBirth'], "date"),
                       GetSQLValueString($_POST['Gender'], "text"),
                       GetSQLValueString($_POST['Race'], "text"),
                       GetSQLValueString($_POST['Religion'], "text"),
                       GetSQLValueString($_POST['ID'], "int"));

  mysql_select_db($database_Connection, $Connection);
  $Result1 = mysql_query($updateSQL, $Connection) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
	$start = strtotime($_POST['StartDate']);
$end = strtotime($_POST['EndDate']);

$days_between = ceil(abs($end - $start) / 86400);
//To prevent unlogical date

 


  $updateSQL = sprintf("UPDATE trainingapplication SET DateOfApplication=%s, DateOfReceived=%s, StartDate=%s, EndDate=%s, Duration=%s, Division=%s, DivisionAccept=%s, StudentAccept=%s, TrainingStatus=%s WHERE ID=%s",
                       GetSQLValueString($_POST['DateApply'], "date"),
                       GetSQLValueString($_POST['DateReceive'], "date"),
                       GetSQLValueString($_POST['StartDate'], "date"),
                       GetSQLValueString($_POST['EndDate'], "date"),
					   GetSQLValueString($days_between, "text"),
                       GetSQLValueString($_POST['Division'], "text"),
                       GetSQLValueString($_POST['DivAccept'], "text"),
                       GetSQLValueString($_POST['StudAccept'], "text"),
                       GetSQLValueString($_POST['TrainStatus'], "text"),
                       GetSQLValueString($_POST['ID'], "int"));

  mysql_select_db($database_Connection, $Connection);
  $Result1 = mysql_query($updateSQL, $Connection) or die(mysql_error());

  $updateGoTo = "TraineeDetailInfo.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_banking = "-1";
if (isset($_GET['ID'])) {
  $colname_banking = $_GET['ID'];
}
mysql_select_db($database_Connection, $Connection);
$query_banking = sprintf("SELECT * FROM bankinginfo WHERE ID = %s", GetSQLValueString($colname_banking, "int"));
$banking = mysql_query($query_banking, $Connection) or die(mysql_error());
$row_banking = mysql_fetch_assoc($banking);
$totalRows_banking = mysql_num_rows($banking);

$colname_contact = "-1";
if (isset($_GET['ID'])) {
  $colname_contact = $_GET['ID'];
}
mysql_select_db($database_Connection, $Connection);
$query_contact = sprintf("SELECT * FROM contactinfo WHERE ID = %s", GetSQLValueString($colname_contact, "int"));
$contact = mysql_query($query_contact, $Connection) or die(mysql_error());
$row_contact = mysql_fetch_assoc($contact);
$totalRows_contact = mysql_num_rows($contact);

$colname_education = "-1";
if (isset($_GET['ID'])) {
  $colname_education = $_GET['ID'];
}
mysql_select_db($database_Connection, $Connection);
$query_education = sprintf("SELECT * FROM educationinfo WHERE ID = %s", GetSQLValueString($colname_education, "int"));
$education = mysql_query($query_education, $Connection) or die(mysql_error());
$row_education = mysql_fetch_assoc($education);
$totalRows_education = mysql_num_rows($education);

$colname_trainee = "-1";
if (isset($_GET['ID'])) {
  $colname_trainee = $_GET['ID'];
}
mysql_select_db($database_Connection, $Connection);
$query_trainee = sprintf("SELECT * FROM traineeinfo WHERE ID = %s", GetSQLValueString($colname_trainee, "int"));
$trainee = mysql_query($query_trainee, $Connection) or die(mysql_error());
$row_trainee = mysql_fetch_assoc($trainee);
$totalRows_trainee = mysql_num_rows($trainee);

$colname_training = "-1";
if (isset($_GET['ID'])) {
  $colname_training = $_GET['ID'];
}
mysql_select_db($database_Connection, $Connection);
$query_training = sprintf("SELECT * FROM trainingapplication WHERE ID = %s", GetSQLValueString($colname_training, "int"));
$training = mysql_query($query_training, $Connection) or die(mysql_error());
$row_training = mysql_fetch_assoc($training);
$totalRows_training = mysql_num_rows($training);
//To disable the option if training status is apply
//<?php if ($row_training['TrainingStatus']=='Not Applicable'){
	//?//>style="display:none"<?php //} ?//>
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Intern Info</title>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="TableCSSCodeEditDetail.css" rel="stylesheet" type="text/css" >
<link href="../../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script>
function validate(){
var DateApply=document.getElementById("DateApply").value;
var DateReceive=document.getElementById("DateReceive").value;

 var StartDate = document.getElementById("StartDate").value;
       var EndDate = document.getElementById("EndDate").value;
       if (DateApply >DateReceive) {
           

	alert("Error!!Date Application is after Receive Date");
		return false;  
	  
	   }
	    
	   else if (StartDate > EndDate) {
         

	alert("Error!!Start date is after End Date");
		return false;
	
        }else {
		alert("Update Successfull!!");
        return true;

		}
    }
 function show(select_item) {	
if (select_item =="NIL") {
		    hiddenDiv.style.display='none';
			
			
		} 
		else{
			
			hiddenDiv.style.display='';
		}
	
 }

</script>
</head>

<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>" onsubmit="return validate()">
  <div align="center">
    <p style="color: rgb(41, 6, 6);
font-size: 50px;
font-family:Arial;
text-shadow: rgb(230, 172, 172) -2px 5px 5px;">
  EDIT TRAINEE INFO</p>
    <table width="324" border="1" class="CSSTableGenerator">
      <tr>
        <td  colspan="2">PERSONAL INFO</td>
      </tr>
      <tr>
        <td width="144">NAME:</td>
        <td width="164"><span id="sprytextfield2"><span style="color: rgb(41, 6, 6);
font-size: 50px;
font-family:Arial;
text-shadow: rgb(230, 172, 172) -2px 5px 5px;">
          <input name="Name" type="text" id="Name3" value="<?php echo $row_trainee['Name']; ?>" />
        </span>
          <label for="Name3"></label>
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
      <tr>
        <td>IC NO:</td>
        <td><span id="sprytextfield3">
        <label for="ICNO"></label>
        <input name="ICNO" type="text" id="ICNO" value="<?php echo $row_trainee['IcNo']; ?>" />
        <span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMaxCharsMsg">IC NO SHOULD CONTAIN 12DIGITS.</span><span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
      <tr>
        <td>HOME ADDRESS:</td>
        <td><span id="sprytextarea1">
          <label for="HomeAddress2"></label>
          <textarea name="HomeAddress" id="HomeAddress2" cols="45" rows="5"><?php echo $row_trainee['HomeAddress']; ?></textarea>
          <span class="textareaRequiredMsg">A value is required.</span></span></td>
  </tr>
      <tr>
        <td>CITY:</td>
        <td><span id="sprytextfield5">
          <label for="City"></label>
          <input name="City" type="text" id="City" value="<?php echo $row_trainee['City']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
      <tr>
        <td>STATE:</td>
        <td><select name="State" id="State" >
          <option hidden selected="selected" value="<?php echo $row_trainee['State']; ?>" ><?php echo $row_trainee['State']; ?></option>
          <option value=" Selangor"> Selangor</option>
          <option value="Kuala Lumpur">Kuala Lumpur</option>
          <option value="Sarawak">Sarawak</option>
          <option value="Johor">Johor</option>
          <option value="Penang">Penang</option>
          <option value="Sabah">Sabah</option>
          <option value="Perak">Perak</option>
          <option value="Pahang">Pahang</option>
          <option value="Negeri Sembilan">Negeri Sembilan</option>
          <option value="Kedah">Kedah</option>
          <option value="Malacca">Malacca</option>
          <option value="Terengganu">Terengganu</option>
          <option value="Kelantan">Kelantan</option>
          <option value="Perlis">Perlis</option>
          <option value="Labuan">Labuan</option>
        </select></td>
      </tr>
      <tr>
        <td>DATE OF BIRTH:        </td>
        <td><span id="sprytextfield6">
          <label for="DateOfBirth"></label>
          <input name="DateOfBirth" type="date" id="DateOfBirth2" value="<?php echo $row_trainee['DateOfBirth']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
      <tr>
        <td>GENDER:</td>
        <td><label for="Gender"></label>
          <select name="Gender" id="Gender" >
          <option selected hidden value="<?php echo $row_trainee['Gender']; ?>"><?php echo $row_trainee['Gender']; ?></option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select></td>
      </tr>
      <tr>
        <td>RACE:</td>
        <td><label for="Race"></label>
          
  <select name="Race" id="Race">
  <option selected hidden value="<?php echo $row_trainee['Race']; ?>"><?php echo $row_trainee['Race']; ?></option>
    <option value="Malay">Malay</option>
    <option value="Chinese">Chinese</option>
    <option value="Indian">Indian</option>
    <option value="Iban">Iban</option>
    <option value="Bidayuh">Bidayuh</option>
    </select></td>
      </tr>
      <tr>
        <td>RELIGION:</td>
        <td><label for="Religion"></label>
         <select name="Religion" id="Religion">
          <option selected hidden value=" <?php echo $row_trainee['Religion']; ?>"><?php echo $row_trainee['Religion']; ?></option>
  
    <option value="Islam">Islam</option>
    <option value="Christian">Christian</option>
    <option value="Buddhism">Buddhism</option>
    <option value="Hinduism">Hinduism</option>
    </select></td>
      </tr>
      <tr>
        <td  colspan="2">CONTACT INFORMATION:</td>
      </tr>
      <tr>
        <td>HANDPHONE NO:</td>
        <td><span id="sprytextfield7">
          <label for="HpNo"></label>
          <input name="HpNo" type="text" id="HpNo" value="<?php echo $row_contact['HandphoneNO']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
  </tr>
      <tr>
        <td>HOME PHONE NO:</td>
        <td><span id="sprytextfield8">
          <label for="HomePhoneNo"></label>
          <input name="HomePhoneNo" type="text" id="HomePhoneNo" value="<?php echo $row_contact['HomePhoneNo']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
  </tr>
      <tr>
        <td>EMAIL ADDRESS:</td>
        <td><span id="sprytextfield9">
          <label for="email"></label>
          <input name="email" type="text" id="email" value="<?php echo $row_contact['EmailAddress']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
  </tr>
      <tr>
        <td>MAILING ADDRESS:</td>
        <td><span id="sprytextfield10">
          <label for="MailingAddress"></label>
          <input name="MailingAddress" type="text" id="MailingAddress" value="<?php echo $row_contact['MailingAddress']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
      <tr>
        <td  colspan="2">BANKING INFORMATION:</td>
      </tr>
      <tr>
        <td>ALLOWANCE:</td>
        <td><label for="Allowance"></label>
         
  <select name="Allowance" id="Allowance">
    <option selected hidden value=" <?php echo $row_banking['Allowance']; ?>"><?php echo $row_banking['Allowance']; ?></option>
      <option value="With Allowance">With Allowance</option>
    <option value="NIL">NiL</option>
    </select></td>

      <tr>
        <td>BANK NAME:</td>
        <td><span id="sprytextfield11">
          <label for="BankName"></label>
          <input name="BankName" type="text" id="BankName" value="<?php echo $row_banking['BankName']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
      <tr>
        <td>ACCOUNT NO:</td>
        <td><span id="sprytextfield12">
          <label for="AccountNo"></label>
          <input name="AccountNo" type="text" id="AccountNo" value="<?php echo $row_banking['AccountNo']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
  </tr>
      <tr>
        <td>PT ALLOWANCE NO:</td>
        <td><div id='hiddenDiv' >Pt Current No:<?php echo $row_banking['PTAllowNo']; ?><br />
          <label for="PtAllowNo"></label>
          <input type="text" name="PtAllow" id="PtAllow" class="PTAllowNo" />
       </div></td>
      </tr>
      <tr>
        <td colspan="2"><span  red">TRAINING APPLICATION:</span></td>
      </tr>
      <tr>
        <td>DATE OF APPLICATION LETTER</td>
        <td><span id="sprytextfield13">
          <label for="DateApply"></label>
          <input name="DateApply" type="date" id="DateApply" value="<?php echo $row_training['DateOfApplication']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
      <tr>
        <td>DATE RECEIVED:</td>
        <td><span id="sprytextfield14">
          <label for="DateReceive"></label>
          <input name="DateReceive" type="date" id="DateReceive" value="<?php echo $row_training['DateOfReceived']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
      <tr>
        <td>START DATE:</td>
        <td><span id="sprytextfield15">
          <label for="StartDate"></label>
          <input name="StartDate" type="date" id="StartDate" value="<?php echo $row_training['StartDate']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span></span>
       <p style="color:red">
         <?php if(!empty($_SESSION['DateInvalid'])) { echo $_SESSION['DateInvalid'];unset($_SESSION['DateInvalid']);} ?>
       </p></td>
  </tr>
      <tr>
        <td>END DATE:</td>
        <td><span id="sprytextfield16">
          <label for="EndDate3"></label>
          <input name="EndDate" type="date" id="EndDate" value="<?php echo $row_training['EndDate']; ?>" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
      <tr>
        <td>DURATION:</td>
        <td><span id="sprytextfield17">
          <label for="Duration"></label>
          <input name="Duration" type="text" id="Duration" value="<?php echo $row_training['Duration']; ?>" style="background-color : #d1d1d1;" readonly="readonly"/>
          <span class="textfieldRequiredMsg">A value is required.</span></span>days</td>
  </tr>
      <tr>
        <td>DIVISION:</td>
        <td>
  
            <select name="Division" size="1" id="Division"> 
                     <option selected hidden value="<?php echo $row_training['Division']; ?>"><?php echo $row_training['Division']; ?></option>
              
              <option value="CFD">Corporate Finance Division(CFD)</option>
              <option value="PTY">Property Division(PTY)</option>
              <option value="ENG">Engineering &amp; Project Management Division(ENG)</option>
              <option value="TNL">Tourism &amp; Leisure Division(T&amp;L)</option>
              <option value="AGRO">Agro-Food Based Division(AGRO)</option>
              <option value="EDD">Entrepreneur Development Division(EDD)</option>
              <option value="RMU">Risk Management Unit(RMU)</option>
              <option value="IAD">Internal Audit Division(IAD)</option>
              <option value="HRA">Human Resource &amp; General Administration Division(HRA)</option>
              <option value="IQD">Innovation &amp; Quality Division(IQD)</option>
              <option value="PMD">Planning &amp; Monitoring Division(PMD)</option>
              <option value="CRC">Corporate Relations &amp; Communications(CRC)</option>
              <option value="ICT">Information &amp; Communications Technology Division(ICT)</option>
            </select>
          </p></td>
      </tr>
      <tr>
        <td>DIVISION ACCEPT:</td>
        <td><label for="DivAccept">
          <select name="DivAccept" id="DivAccept">
            <option selected="selected" hidden="hidden" value="<?php echo $row_training['DivisionAccept']; ?>"><?php echo $row_training['DivisionAccept']; ?></option>
            <option value="YES">YES</option>
            <option value="NO">NO</option>
          </select>
        </label></td>
      </tr>
      <tr>
        <td>STUDENT ACCEPT:</td>
        <td>
  <select name="StudAccept" id="StudAccept">
  <option selected="selected" hidden="hidden" value="<?php echo  $row_training['StudentAccept']; ?>"><?php echo  $row_training['StudentAccept']; ?></option>
    <option value="YES">YES</option>
    <option value="NO">NO</option>
    </select></td>
      </tr>
      <tr>
        <td>TRAINING STATUS:</td>
        <td><strong><?php echo $row_training['TrainingStatus'];?></strong>
<div id="edittype">
 
        Change to:          
          <select name="TrainStatus" id="TrainStatus" >
            <option selected="selected" hidden="hidden" value="<?php echo  $row_training['TrainingStatus']; ?>"><?php echo  $row_training['TrainingStatus']; ?></option>
            <option value="UpComing">UpComing</option>
            <option value="Current">Current</option>
            <option value="Completed">Completed</option>
            <option value="Incomplete">Incomplete</option>
            <option value="Dismissed">Dismissed</option>
            <option value="Transfer">Transfer</option>
          </select>
</div></td>
      </tr>
      <tr>
        <td colspan="2"><span >EDUCATION BACKGROUND</span></td>
      </tr>
      <tr>
        <td>UNIVERSITY:</td>
        <td><span id="sprytextfield18">
          <label for="University"></label>
          <input name="University" type="text" id="University" value="<?php echo $row_education['University']; ?>" size="70" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
      <tr>
        <td>QUALIFICATION:</td>
        <td><span id="sprytextfield19">
          <label for="Qualification"></label>
          <input name="Qualification" type="text" id="Qualification" value="<?php echo $row_education['Qualification']; ?>" size="70"/>
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
      <tr>
        <td></td>
        <td><input type="image" src="Image/UpdateButton.jpg" alt="Submit" width="80" height="48"></td>
      </tr>
    </table>
    <span id="sprytextfield1">
  </span></div>
  <span id="sprytextfield1">
  <label for="Name2"></label>
  <div align="center"><span class="textfieldRequiredMsg">A value is required.</span></div>
  </span>
  <div align="center"><a href="AdminHomePage.php"></a>
    <input type="hidden" name="ID" value="<?php echo $row_trainee['ID']; ?>" />
    <input type="hidden" name="MM_insert" value="form1" />
    <input type="hidden" name="MM_update" value="form1" />
  <a href="AdminHomePage.php"></a></div>
</form>
<div align="center">
  <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {maxChars:12, useCharacterMasking:true});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "integer");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "integer");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "email");
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11");
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12", "integer");
var sprytextfield17 = new Spry.Widget.ValidationTextField("sprytextfield17", "none", {validateOn:["blur"]});
var sprytextfield18 = new Spry.Widget.ValidationTextField("sprytextfield18");
var sprytextfield19 = new Spry.Widget.ValidationTextField("sprytextfield19");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15");
var sprytextfield16 = new Spry.Widget.ValidationTextField("sprytextfield16");
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13");
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14");
  </script>
</div>
<p align="center"><a href="AdminHomePage.php">
  <input type="image" src="Image/backtohomepage.jpg" alt="Submit"  width="100" height="48" />
  </a></p>
<script type="text/javascript">
var sprytextfield19 = new Spry.Widget.ValidationTextField("sprytextfield19");
var sprytextfield18 = new Spry.Widget.ValidationTextField("sprytextfield18");
var sprytextfield17 = new Spry.Widget.ValidationTextField("sprytextfield17", "none", {validateOn:["blur"]});
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15");
var sprytextfield16 = new Spry.Widget.ValidationTextField("sprytextfield16");
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14");
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13");
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12", "integer");
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11");
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "email");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "integer");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "integer");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {maxChars:12, useCharacterMasking:true});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
</script>
</body>
</html>
<?php
mysql_free_result($banking);

mysql_free_result($contact);

mysql_free_result($education);

mysql_free_result($trainee);

mysql_free_result($training);
?>
