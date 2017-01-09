<!DOCTYPE html>
<html>

<head>
	<title>ระบบประเมินภาวะทางโภชนาการ (PG-SGA)</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"> 
	<link rel="stylesheet" href="css/jquery.mobile-1.3.0.min.css" />
	<script src="js/jquery-1.8.2.min.js"></script>
	<script src="js/jquery.mobile-1.3.0.min.js"></script>		

	<link rel="stylesheet" type="text/css" href="bartender.css" /> 
</head>

<body>
	
	<div data-role="page" id="page-home">			
		<div data-role="header" data-position="fixed" data-theme="b">				
		<p style="text-align:center;"><table align="center"><td>การประเมินภาวะทางโภชนาการ</td><td>ยินดีต้อนรับ : <?php require_once('conPGSGA.php');
$strSQL = "SELECT Name FROM staff WHERE (PN = '".$_POST["Name"]."') ";
$objQuery = mysql_query($strSQL);	
	while($objResult = mysql_fetch_array($objQuery))
{
	echo "<font color=\"red\">*</font>";
				 echo $objResult["Name"];
				 echo "<font color=\"red\">*</font>";
}
	
	//mysql_close($objConnect);

?></td></td> </td></table></p>	
				<!--<h4>ฟุตเตอร์</h4>-->		
		<div data-role= "navbar">
				<ul class="apple-navbar-ui comboSprite">

					<li><form method="post" action="search_patient.php">
					 <input type="hidden" name="Name" value=" <?php echo $_POST["Name"]; ?> ">
                <input type="submit" value="หน้าหลัก"data-iconpos="right" data-icon="home" data-theme="c">
            </form></li>
					<li><form method="post" action="welcome_pro1.php">
					 <input type="hidden" name="Name" value=" <?php echo $_POST["Name"]; ?> ">
                <input type="submit" value="รายชื่อผู้ป่่วยที่ต้องทำเเบบประเมิน"data-iconpos="right" data-icon="info" >
 
            </form></li>
					<li><form method="post" action="assesstmentPatientdetail.php">
					 <input type="hidden" name="Name" value=" <?php echo $_POST["Name"]; ?> ">
                <input type="submit" value="ผลการทำเเบบประเมินของผู้ป่วยทั้งหมด"data-iconpos="right" data-icon="edit">
 
            </form></li>
					<li><form method="post" action="index.html">
					 <input type="hidden" name="Name" value=" <?php echo $_POST["Name"]; ?> ">
                <input type="submit" value="ผลการทำเเบบประเมินของบุคลากรทางการเเพทย์"data-iconpos="right" data-icon="edit">
 
            </form></li>
				</ul>
			</div>
			<div data-role= "navbar">
				<ul class="apple-navbar-ui comboSprite">

					
					<li><form method="post" action="search_patient.php">
					 <input type="hidden" name="Name" value=" <?php echo $_POST["Name"]; ?> ">
                <input type="submit" value="ตรวจสอบการเเก้ไขข้อมูล"data-iconpos="right" data-icon="check">
            </form></li>
						<li><form method="post" action="search_patient.php">
					 <input type="hidden" name="Name" value=" <?php echo $_POST["Name"]; ?> ">
                <input type="submit" value="ปรับปรุงข้อมูล"data-iconpos="right" data-icon="gear">
            </form></li>
 
            </form></li>
					<li><form method="post" action="index.html">
					 <input type="hidden" name="Name" value=" <?php echo $_POST["Name"]; ?> ">
                <input type="submit" value="ออกจากระบบ"data-iconpos="right" data-icon="delete" >
 
            </form></li>
				</ul>
			</div>
		</div>

	<form name="form1" method="post" action="search_patient2.php">
  <table width=100% border="0">
      <td style="text-align:center;">กรอกคำที่ใช้ค้นหา:<input name="txtHN" type="text" id="txtHN" ></td>
	  <td>ค้นหาโดยใช้:  <select name ="selSearch" id = "select-id" data-native-menu = "false" style="background-color:#FFC547;">
	                <option value="1">HN:เลขประจำตัวในโรงพยาบาล</option>
                    <option value="2">ชื่อผู้ป่วย</option>
                    <option  value="3">ชื่อบุคลากรที่รับผิดชอบ</option>
             </select></td>
	  <!--<td style="text-align:center;">ชื่อผู้ป่วย:<input name="txtName" type="text" id="txtName" ></td>
	  <td style="text-align:center;">ชื่อบุคลากรที่รับผิดชอบ:<input name="txtHN2" type="text" id="txtHN2" ></td>-->
	  
	   <input type="hidden" name="Name" value=" <?php echo $_POST["Name"]; ?> ">
     <!-- <input name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $_GET["txtKeyword"];?>">-->
    <td>กดปุ่มเพื่อค้นหา:  <input type="submit" value="ค้นหา" data-icon="search"></td>
   

	
  </table>
</form>

<center>
<script>
function hiddenn(pvar) {
		document.getElementById("txt1").value = pvar ;
			document.getElementById("txt2").value = pvar ;
				document.getElementById("txt3").value = pvar ;
					document.getElementById("txt4").value = pvar ;
						document.getElementById("txt5").value = pvar ;

	 
}
</script>
<body onload="hiddenn('0')">
<form>
<?php
if($_POST["selSearch"] == "1" )
	{//if1
	require_once('conPGSGA.php');
	$strSQL = "SELECT * FROM patients WHERE (HN LIKE '%".$_POST["txtHN"]."%' )";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
{
	echo "ไม่พบรายการที่ค้นหา : ".$_POST["txtHN"]; 
	echo "คุณสามารถทำการสมัครข้อมูลให้ผู้ป่วยได้ จากปุ่มด้านล่าง(เพิ่มรายชื่อผู้ป่วย) "; 
}
else
		{
	?>

	<table width="90%" border="1">
	  <tr>
	<th width="10%" border="10%"> <div align="center"></div></th>
    <th width="30%"> <div align="center">HN :</div></th>
	<th width="30%"> <div align="center">ชื่อผู้ป่วย :</div></th>
	<th width="30%"> <div align="center">ชื่อบุคลากรที่รับผิดชอบ :</div></th>
	<th width="40%"> <div align="center">สถานะ :</div></th>
	  </tr>
	<?php
	while($objResult = mysql_fetch_array($objQuery))
	{//While 1
	?>
	  <tr>
	  <td><input style="width:10%;" type = "radio" name = "ofp" value = "<?php echo $objResult["HN"] ?>" OnClick="hiddenn('<?php echo $objResult["HN"];?>')"/> <label for="ofp1" style="width:50%;"></label></td>
	<td><div align="center"><?php echo $objResult["HN"];?></div></td>
	<td><div align="center"><?php echo $objResult["Name"];?></div></td>
	<td><div align="center"><?php 
	$strSQL = "SELECT NamePN FROM round WHERE (HN = '".$objResult["HN"]."')";
	$objQuery2 = mysql_query($strSQL);
	while($objResult2 = mysql_fetch_array($objQuery2))
{//while2
		echo $objResult2["NamePN"];
}//while2
	?></div></td>
	<td><div align="center"><?php 

		echo "Start";

	?></div></td></tr>
	<?php
	}//while1
	?>
	</table>

	<?php
	mysql_close($objConnect);

		}
}//if1

else if($_POST["selSearch"] == "2" )
	{//if1
	require_once('conPGSGA.php');
	$strSQL = "SELECT * FROM patients WHERE (Name LIKE '%".$_POST["txtHN"]."%' )";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
{
	echo "ไม่พบรายการที่ค้นหา : ".$_POST["txtHN"]; 
	echo "คุณสามารถทำการสมัครข้อมูลให้ผู้ป่วยได้ จากปุ่มด้านล่าง(เพิ่มรายชื่อผู้ป่วย) "; 
}
else
		{
	?>
	<table width="90%" border="1">
	  <tr>
	<th width="10%" border="10%"> <div align="center"></div></th>
    <th width="30%"> <div align="center">HN :</div></th>
	<th width="30%"> <div align="center">ชื่อผู้ป่วย :</div></th>
	<th width="30%"> <div align="center">ชื่อบุคลากรที่รับผิดชอบ :</div></th>
	<th width="40%"> <div align="center">สถานะ :</div></th>
	  </tr>
	<?php
	while($objResult = mysql_fetch_array($objQuery))
	{//While 1
	?>
	  <tr>
	  <td><input style="width:10%;" type = "radio" name = "ofp" value = "<?php echo $objResult["HN"] ?>" OnClick="hiddenn('<?php echo $objResult["HN"];?>')"/> <label for="ofp1" style="width:50%;"></label></td>
	<td><div align="center"><?php echo $objResult["HN"];?></div></td>
	<td><div align="center"><?php echo $objResult["Name"];?></div></td>
	<td><div align="center"><?php 
	$strSQL = "SELECT NamePN FROM round WHERE (HN = '".$objResult["HN"]."')";
	$objQuery2 = mysql_query($strSQL);
	while($objResult2 = mysql_fetch_array($objQuery2))
{//while2
		echo $objResult2["NamePN"];
}//while2
	?></div></td>
	<td><div align="center"><?php 

		echo "Start";

	?></div></td></tr>
	<?php
	}//while1
	?>
	</table>

	<?php
	mysql_close($objConnect);


}//if2


else if($_POST["selSearch"] == "3" )
	{//if1
	require_once('conPGSGA.php');
	$strSQL = "SELECT * FROM patients WHERE (Name LIKE '%".$_POST["txtHN"]."%' )";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	?>
	<table width="90%" border="1">
	  <tr>
	<th width="10%" border="10%"> <div align="center"></div></th>
    <th width="30%"> <div align="center">HN :</div></th>
	<th width="30%"> <div align="center">ชื่อผู้ป่วย :</div></th>
	<th width="30%"> <div align="center">ชื่อบุคลากรที่รับผิดชอบ :</div></th>
	<th width="40%"> <div align="center">สถานะ :</div></th>
	  </tr>
	<?php
	while($objResult = mysql_fetch_array($objQuery))
	{//While 1
	?>
	  <tr>
	  <td><input style="width:10%;" type = "radio" name = "ofp" value = "<?php echo $objResult["HN"] ?>" OnClick="hiddenn('<?php echo $objResult["HN"];?>')"/> <label for="ofp1" style="width:50%;"></label></td>
	<td><div align="center"><?php echo $objResult["HN"];?></div></td>
	<td><div align="center"><?php echo $objResult["Name"];?></div></td>
	<td><div align="center"><?php 
	$strSQL = "SELECT NamePN FROM round WHERE (HN = '".$objResult["HN"]."')";
	$objQuery2 = mysql_query($strSQL);
	while($objResult2 = mysql_fetch_array($objQuery2))
{//while2
		echo $objResult2["NamePN"];
}//while2
	?></div></td>
	<td><div align="center"><?php 

		echo "Start";

	?></div></td></tr>
	<?php
	}//while1
	?>
	</table>

	<?php
	mysql_close($objConnect);


}//if3
?>
<table width=100% border="0">
<td><th width="30"> <div align="center"><form method="post" action="add_users.php">
				<input type="hidden" name="Name" value=" <?php echo $_POST["Name"]; ?> ">
				<input type="hidden" name="Name2" value=" <?php echo $objResult["HN"]; ?> ">
				 <input type="hidden" name="Name3" id="txt1" />
				  <input type="submit" value="เพิ่มรายชื่อผู้ป่วย"data-icon="arrow-r" ></form></div></th>
                </form></div></th></td>

<td><th width="30"> <div align="center"><form method="post" action="response.php">
				<input type="hidden" name="Name" value=" <?php echo $_POST["Name"]; ?> ">
				<input type="hidden" name="Name2" value=" <?php echo $objResult["HN"]; ?> ">
				 <input type="hidden" name="Name5" value="<?php 
$strSQL = "SELECT Name FROM staff WHERE (PN = '".$_POST["Name"]."') ";
$objQuery4 = mysql_query($strSQL);	
	while($objResult4 = mysql_fetch_array($objQuery4))
{

				 echo $objResult4["Name"];
}
	
	//mysql_close($objConnect);

?>">
				 <input type="hidden" name="Name3" id="txt4" />
                <input type="submit" value="ผู้รับผิดชอบ" data-icon="arrow-r"></form></div></th></td>

	<td><th width="30"> <div align="center"><form method="post" action="frmpro_9.php">
				<input type="hidden" name="Name" value=" <?php echo $_POST["Name"]; ?> ">
				<input type="hidden" name="Name2" value="<?php echo $objResult["HN"]; ?> ">
				 <input type="hidden" name="Name3" id="txt3" />
                <input type="submit" value="ทำเเบบประเมิน"data-icon="arrow-r" ></form></div></th></td>

	<td><th width="30"> <div align="center"><form method="post" action="assesst.php">
					 <input type="hidden" name="Name" value=" <?php echo $_POST["Name"]; ?> ">
					  <input type="hidden" name="Name3" id="txt2" />
                <input type="submit" value="ดูผลการประเมิน" data-icon="arrow-r"disabled></form></div></th></td>

	<td><th width="30"> <div align="center"><form method="post" action="response2.php">
					 <input type="hidden" name="Name" value=" <?php echo $_POST["Name"]; ?> ">
					 <input type="hidden" name="Name2" value=" <?php echo $objResult["HN"]; ?> ">
					 <input type="hidden" name="Name3" id="txt5" />
					 <?php
require_once('conPGSGA.php');
$strSQL = "SELECT * FROM code_status";
$objQuery = mysql_query($strSQL);
//$objExec = odbc_exec($conn, $strSQL) or die ("Error Execute [".$strSQL."]");
?>
					 <select name ="selectState" id = "select-id2" data-native-menu = "false" >
<option><li data-role="list-divider"> เปลี่ยนสถานะ </li></option>
<?php
while($objResult = mysql_fetch_array($objQuery))
{
?>
	<option value = <?php echo $objResult["Description"]   ?>>
	<?php echo $objResult["Description"]  ?>
	</option>
<?php
}	
?>

</select>
                <input type="submit" value="ยืนยัน" data-icon="arrow-r">
				</form></div></th></td>
</table>

</form>
</center>


      
		<div data-role="footer" data-position="fixed" data-theme="b">
		<p style="text-align:center;">by Computer Science @Thammasat Uni.</p>	
		
	</div>
	
</body>	
</html>
