<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
  <table width="324" border="1">
    <tr>
      <td style="color:red;" colspan="2"> EDIT PERSONAL INFO</td>
    </tr>
    <tr>
      <td width="144">NAME:</td>
      <td width="164"><span id="sprytextfield2">
        <label for="Name3"></label>
        <input type="text" name="Name" id="Name3" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
</tr>
    <tr>
      <td>IC NO:</td>
      <td><span id="sprytextfield3">
        <label for="ICNO"></label>
        <input type="text" name="ICNO" id="ICNO" />
        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
</tr>
    <tr>
      <td>HOME ADDRESS:</td>
      <td><span id="sprytextfield4">
        <label for="HomeAddress"></label>
        <input type="text" name="HomeAddress" id="HomeAddress" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
</tr>
    <tr>
      <td>CITY:</td>
      <td><span id="sprytextfield5">
        <label for="City"></label>
        <input type="text" name="City" id="City" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
</tr>
    <tr>
      <td>STATE:</td>
      <td><label for="State"></label>
        <select name="State" id="State">
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
        <select name="Gender" id="Gender">
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select></td>
    </tr>
    <tr>
      <td>RACE:</td>
      <td><label for="Race"></label>
        <select name="Race" id="Race">
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
          <option value="Islam">Islam</option>
          <option value="Christian">Christian</option>
          <option value="Buddhism">Buddhism</option>
          <option value="Hinduism">Hinduism</option>
        </select></td>
    </tr>
    <tr>
      <td style="color:red;" colspan="2">EDIT CONTACT INFORMATION:</td>
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
        <input type="text" name="MailingAddress" id="MailingAddress" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
</tr>
    <tr>
      <td style="color:red;" colspan="2">EDIT BANKING INFORMATION:</td>
    </tr>
    <tr>
      <td>ALLOWANCE:</td>
      <td><label for="Allowance"></label>
        <select name="Allowance" id="Allowance">
          <option value="With Allowance">With Allowance</option>
          <option value="NIL">NiL</option>
        </select></td>
    </tr>
    <tr>
      <td>BANK NAME:</td>
      <td><span id="sprytextfield11">
        <label for="BankName"></label>
        <input type="text" name="BankName" id="BankName" />
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
      <td colspan="2"><span style="color: red">EDIT TRAINING APPLICATION:</span></td>
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
        <input type="date" name="EndDate" id="EndDate3" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
</tr>
    <tr>
      <td>DURATION:</td>
      <td><span id="sprytextfield17">
        <label for="Duration"></label>
        <input type="text" name="Duration" id="Duration" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
</tr>
    <tr>
      <td>DIVISION:</td>
      <td><label for="Division"></label>
        <select name="Division" size="1" id="Division" value="Select Category">
          <option value="General">General Case</option>
          <option value="CFD" selected="selected">Corporate Finance Division(CFD)</option>
          <option value="PTY">Property Division(PTY)</option>
          <option value="ENG">Engineering &amp; Project Management Division(ENG)</option>
          <option value="TNL">Tourism &amp; Leisure Division(T&amp;L)</option>
          <option value="AGRO">Agro-Food Based Division(AGRO)</option>
          <option value="EDD">Entrepreneur Development Division(EDD)</option>
          <option value="RMU">Risk Management Unit(RMU)</option>
          <option value="IAD">Internal Audit Division(IAD)</option>
          <option value="HRA">Human Resource &amp; General Administration Division(HRA)</option>
          <option value="IQD">Innovation &amp; Quality Division(IQD)</option>
          <option>Planning &amp; Monitoring Division(PMD)</option>
          <option value="CRC">Corporate Relations &amp; Communications(CRC)</option>
          <option value="ICT">Information &amp; Communications Technology Division(ICT)</option>
        </select></td>
    </tr>
    <tr>
      <td>DIVISION ACCEPT:</td>
      <td><label for="DivAccept"></label>
        <select name="DivAccept" id="DivAccept">
          <option value="YES">YES</option>
          <option value="NO">NO</option>
        </select></td>
    </tr>
    <tr>
      <td>STUDENT ACCEPT:</td>
      <td><select name="StudAccept" id="StudAccept">
        <option value="YES">YES</option>
        <option value="NO">NO</option>
      </select></td>
    </tr>
    <tr>
      <td>TRAINING STATUS:</td>
      <td><label for="TrainStatus"></label>
        <select name="TrainStatus" id="TrainStatus">
          <option value="Current">Current</option>
          <option value="Completed">Completed</option>
          <option value="Incomplete">Incomplete</option>
          <option value="Dismissed">Dismissed</option>
          <option value="Transfer">Transfer</option>
        </select></td>
    </tr>
    <tr>
      <td colspan="2"><span style="color: red">EDIT EDUCATION BACKGROUND</span></td>
    </tr>
    <tr>
      <td>UNIVERSITY:</td>
      <td><span id="sprytextfield18">
        <label for="University"></label>
        <input type="text" name="University" id="University" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
</tr>
    <tr>
      <td>QUALIFICATION:</td>
      <td><span id="sprytextfield19">
        <label for="Qualification"></label>
        <input type="text" name="Qualification" id="Qualification" />
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
</tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" value="Register" /></td>
    </tr>
  </table>
  <span id="sprytextfield1">
  <label for="Name2"></label>
  <span class="textfieldRequiredMsg">A value is required.</span></span>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {minChars:12, maxChars:13});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "integer");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "integer");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "email");
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11");
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12", "integer");
var sprytextfield17 = new Spry.Widget.ValidationTextField("sprytextfield17");
var sprytextfield18 = new Spry.Widget.ValidationTextField("sprytextfield18");
var sprytextfield19 = new Spry.Widget.ValidationTextField("sprytextfield19");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15");
var sprytextfield16 = new Spry.Widget.ValidationTextField("sprytextfield16");
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13");
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14");
</script>
<form name="form1" method="post" action="<?php echo $editFormAction; ?>">
  <table width="324" border="1">
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
    <tr> </tr>
  </table>
</form>
<script type="text/javascript">
var sprytextfield19 = new Spry.Widget.ValidationTextField("sprytextfield19");
var sprytextfield18 = new Spry.Widget.ValidationTextField("sprytextfield18");
var sprytextfield17 = new Spry.Widget.ValidationTextField("sprytextfield17");
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
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {minChars:12, maxChars:13});
</script>
</body>
</html>