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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO traineeinfo (Name, IcNo, HomeAddress, City, `State`, DateOfBirth, Gender, Race, Religion) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['ICNO'], "text"),
                       GetSQLValueString($_POST['HomeAddress'], "text"),
                       GetSQLValueString($_POST['City'], "text"),
                       GetSQLValueString($_POST['State'], "text"),
                       GetSQLValueString($_POST['DateOfBirth'], "date"),
                       GetSQLValueString($_POST['Gender'], "text"),
                       GetSQLValueString($_POST['Race'], "text"),
                       GetSQLValueString($_POST['Religion'], "text"));

  mysql_select_db($database_Connection, $Connection);
  $Result1 = mysql_query($insertSQL, $Connection) or die(mysql_error());

}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO bankinginfo (Allowance, BankName, AccountNo,PTAllowNo) VALUES (%s, %s, %s,%s)",
                       GetSQLValueString($_POST['Allowance'], "text"),
                       GetSQLValueString($_POST['BankName'], "text"),
                       GetSQLValueString($_POST['AccountNo'], "text"),
					   GetSQLValueString($_POST['PtAllow'], "text"));

  mysql_select_db($database_Connection, $Connection);
  $Result1 = mysql_query($insertSQL, $Connection) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO educationinfo (University, Qualification) VALUES (%s, %s)",
                       GetSQLValueString($_POST['University'], "text"),
                       GetSQLValueString($_POST['Qualification'], "text"));

  mysql_select_db($database_Connection, $Connection);
  $Result1 = mysql_query($insertSQL, $Connection) or die(mysql_error());
}

mysql_select_db($database_Connection, $Connection);
$query_Recordset1 = "SELECT * FROM bankinginfo ORDER BY ID DESC";
$Recordset1 = mysql_query($query_Recordset1, $Connection) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$DivAnswer=$_POST['DivAccept'];//Variable to pass to condition if the answer 
	$StudAnswer=$_POST['StudAccept'];
	$StartDate=new DateTime($_POST['StartDate']);
	$EndDate=new DateTime($_POST['EndDate']);
	if($DivAnswer='NO' or $StudAnswer='NO'){
		$Answer='Not Applicable';
	}else{
		$Answer='Current';
	}
	$diff=date_diff($StartDate,$EndDate);
	$diffDays=$diff->format("%R%a days");
		$start = strtotime($_POST['StartDate']);
$end = strtotime($_POST['EndDate']);

$days_between = ceil(abs($end - $start) / 86400);
  $insertSQL = sprintf("INSERT INTO trainingapplication (DateOfApplication, DateOfReceived, StartDate, EndDate, Duration, Division, DivisionAccept, StudentAccept, TrainingStatus) VALUES (%s, %s, %s, %s, '$diffDays', %s, %s, %s, '$Answer')",
                       GetSQLValueString($_POST['DateApply'], "date"),
                       GetSQLValueString($_POST['DateReceive'], "date"),
                       GetSQLValueString($_POST['StartDate'], "date"),
                       GetSQLValueString($_POST['EndDate'], "date"),
                       GetSQLValueString($_POST['Division'], "text"),
                       GetSQLValueString($_POST['DivAccept'], "text"),
                       GetSQLValueString($_POST['StudAccept'], "text"));
 

  mysql_select_db($database_Connection, $Connection);
  $Result1 = mysql_query($insertSQL, $Connection) or die(mysql_error());
}



if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO contactinfo (HandphoneNO, HomePhoneNo, EmailAddress, MailingAddress) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['HpNo'], "text"),
                       GetSQLValueString($_POST['HomePhoneNo'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['MailingAddress'], "text"));

  mysql_select_db($database_Connection, $Connection);
  $Result1 = mysql_query($insertSQL, $Connection) or die(mysql_error());

  $insertGoTo = "AdminHomePage.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }

 echo "<script>
 alert('Successfull Registration!!');
 location.href='AdminHomePage.php'
 
 </script>";
 

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register New Intern</title>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="TableCSSCodeRegisterIntern.css" rel="stylesheet" type="text/css" >
<script language="javascript">
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
<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <div align="center">
    <p style="color: rgb(41, 6, 6);
font-size: 50px;
font-family:Arial;
text-shadow: rgb(230, 172, 172) -2px 5px 5px;">REGISTER NEW INTERN</p>
    <table width="324" border="1" class="CSSTableGenerator">
      <tr>
        <td  colspan="2">PERSONAL INFORMATION:</td>
      </tr>
      
      <tr>
        <td width="144">NAME:</td>
        <td width="164"><span id="sprytextfield2">
          <label for="Name3"></label>
          <input type="text" name="Name" id="Name3" size="80" style="text-transform:uppercase"/>
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td>IC NO:</td>
        <td><span id="sprytextfield3">
        <label for="ICNO"></label>
        <input name="ICNO" type="text" id="ICNO" />
        <span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMaxCharsMsg">IC NO SHOULD CONTAIN 12DIGITS..</span><span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td>HOME ADDRESS:</td>
        <td><span id="sprytextfield4">
          <label for="HomeAddress"></label>
          <textarea name="HomeAddress" id="HomeAddress" rows="5" cols="55" style="text-transform:uppercase"/></textarea >
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td>CITY:</td>
        <td><span id="sprytextfield5">
          <label for="City"></label>
          <input type="text" name="City" id="City" style="text-transform:uppercase"/>
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td>STATE:</td>
        <td><select name="State" id="State" required>
          <option selected disabled hidden value='' >Select State</option>
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
        <td>DATE OF BIRTH:</td>
        <td><span id="sprytextfield6">
          <label for="DateOfBirth"></label>
          <input type="date" name="DateOfBirth" id="DateOfBirth2" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td>GENDER:</td>
        <td><label for="Gender"></label>
          <select name="Gender" id="Gender" required>
          <option selected disabled hidden value='' required>Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select></td>
      </tr>
      <tr>
        <td>RACE:</td>
        <td><label for="Race"></label>
          <select name="Race" id="Race" required>
          <option selected disabled hidden value='' >Select Race</option>
            <option value="Malay">Malay</option>
            <option value="Chinese">Chinese</option>
            <option value="Indian">Indian</option>
            <option value="Iban">Iban</option>
            <option value="Bidayuh">Bidayuh</option>
        </select></td>
      </tr>
      <tr>
        <td>RELIGION:</td>
        <td><label for="Religion">
          <select name="Religion" id="Religion" required>
            <option selected disabled hidden value='' >Select Religion</option>
            <option value="Islam">Islam</option>
            <option value="Christian">Christian</option>
            <option value="Buddhism">Buddhism</option>
            <option value="Hinduism">Hinduism</option>
          </select>
        </label></td>
      </tr>
      <tr>
        <td  colspan="2">CONTACT INFORMATION:</td>
      </tr>
      <tr>
        <td>HANDPHONE NO:</td>
        <td><span id="sprytextfield7">
          <label for="HpNo"></label>
          <input type="text" name="HpNo" id="HpNo" />
        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
      </tr>
      <tr>
        <td>HOME PHONE NO:</td>
        <td><span id="sprytextfield8">
          <label for="HomePhoneNo"></label>
          <input type="text" name="HomePhoneNo" id="HomePhoneNo" />
        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
      </tr>
      <tr>
        <td>EMAIL ADDRESS:</td>
        <td><span id="sprytextfield9">
          <label for="email"></label>
          <input type="text" name="email" id="email" />
        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
      </tr>
      <tr>
        <td>MAILING ADDRESS:</td>
        <td><span id="sprytextfield10">
          <label for="MailingAddress"></label>
        
          <input type="checkbox" name="Copy" onclick="CopyAddress(this.form)">Copy from Home Address<br>
           <textarea name="MailingAddress" id="MailingAddress" rows="5" cols="55" style="text-transform:uppercase"/></textarea >
   
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td  colspan="2">BANKING INFORMATION:</td>
      </tr>
      <tr>
        <td>ALLOWANCE:</td>
        <td><label for="Allowance"></label>
          <select name="Allowance" id="Allowance" onchange="java_script_:show(this.options[this.selectedIndex].value)" value="">
            <option  value='With Allowance'>With Allowance</option>
            <option  value='NIL'>NiL</option>
        </select></td>
      </tr>
      <tr>
        <td>BANK NAME:</td>
        <td><span id="sprytextfield11">
          <label for="BankName"></label>
          <input type="text" name="BankName" id="BankName" style="text-transform:uppercase"/>
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td>ACCOUNT NO:</td>
        <td><span id="sprytextfield12">
        <label for="AccountNo"></label>
        <input type="text" name="AccountNo" id="AccountNo" />
        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
      </tr>
      <tr>
     
        <td><p>LATEST PT ALLOWANCE NO:</p></td>
        <td>
          <div id='hiddenDiv' >Pt Current No:<strong><?php echo $row_Recordset1['PTAllowNo']; ?></strong><span id="sprytextfield20"><br />
          <input type="text" name="PtAllow" id="PtAllow" class="PTAllowNo" style="text-transform:uppercase"/>
        </span> </div></td>
         
      </tr>
      <tr>
        <td colspan="2"><span >TRAINING APPLICATION:</span></td>
      </tr>
      <tr>
        <td>DATE OF APPLICATION LETTER</td>
        <td><span id="sprytextfield13">
          <label for="DateApply"></label>
          <input type="date" name="DateApply" id="DateApply" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td>DATE RECEIVED:</td>
        <td><span id="sprytextfield14">
          <label for="DateReceive"></label>
          <input type="date" name="DateReceive" id="DateReceive" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td>START DATE:</td>
        <td><span id="sprytextfield15">
          <label for="StartDate"></label>
          <input type="date" name="StartDate" id="StartDate" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td>END DATE:</td>
        <td><span id="sprytextfield16">
          <label for="EndDate3"></label>
          <input type="date" name="EndDate" id="EndDate" />
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td>DIVISION:</td>
        <td><label for="Division"></label>
          <select name="Division" size="1" id="Division" required >
        <option selected disabled hidden value='' >Select Division</option>
            <option value="CFD" >Corporate Finance Division(CFD)</option>
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
        </select></td>
      </tr>
      <tr>
        <td>DOES DIVISION ACCEPT TRAINEE?</td>
        <td>
        <input type="radio" name="DivAccept" id="DivAccept" value="YES">YES
        <input type="radio" name="DivAccept" id="DivAccept" value="YES">NO
        </td>
      </tr>
      <tr>
        <td>DOES STUDENT ACCEPT TRAINING?</td>
  
        <td> <input type="radio" name="StudAccept" id="StudAccept" value="YES">YES
        <input type="radio" name="StudAccept" id="StudAccept" value="NO">NO</td>
      </tr>
      <tr>
        <td colspan="2"><span >EDUCATION BACKGROUND:</span></td>
      </tr>
      <tr>
        <td>LEARNING INSTITUTION:</td>
        <td><span id="sprytextfield18">
          <label for="University"></label>
          <input type="text" name="University" id="University" style="text-transform:uppercase"/>
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td>QUALIFICATION:</td>
        <td><span id="sprytextfield19">
          <label for="Qualification"></label>
          <input type="text" name="Qualification" id="Qualification" style="text-transform:uppercase"/>
          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      </tr>
      <tr>
        <td>
</td>
        <td><input type="image" src="Image/Register.jpg" value="Register" width="100" height="30"></td>
      </tr>
    </table>
    <span id="sprytextfield1">
    </span></div>
  <span id="sprytextfield1">
  <label for="Name2"></label>
  <div align="center"><span class="textfieldRequiredMsg">A value is required.</span></div>
  </span>
  <div align="center">
    <input type="hidden" name="MM_insert" value="form1" />
    
  </div>
</form>
<div align="center"> </div>
<p align="center"><a href="AdminHomePage.php">
  <input  type="image" src="Image/backtohomepage.jpg" alt="Submit"  width="90" height="40" />
</a></p>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {maxChars:12, useCharacterMasking:true});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "integer", {useCharacterMasking:true});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "integer", {useCharacterMasking:true});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "email");
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11");
var sprytextfield18 = new Spry.Widget.ValidationTextField("sprytextfield18");
var sprytextfield19 = new Spry.Widget.ValidationTextField("sprytextfield19");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15");
var sprytextfield16 = new Spry.Widget.ValidationTextField("sprytextfield16");
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13");
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14");
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12", "integer", {useCharacterMasking:true});
var sprytextfield20 = new Spry.Widget.ValidationTextField("sprytextfield20", "none", {isRequired:false});
</script>
</body>

</html>
<?php
mysql_free_result($Recordset1);
?>
