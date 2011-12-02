<?php
	include("common.inc");
	display_header();
	$hoursstr='';
	for($i=1;$i<25;$i++)
	{
		if($i==8)
		{
			$hoursstr.="<option value='".$i."' selected='true'>".$i."</option>";
		}
		else
		{
			$hoursstr.="<option value='".$i."'>".$i."</option>";
		}
	}
	$minutes='';
	for($i=0;$i<59;$i++)
	{
		if($i==30)
		{
			$minutes.="<option value='".$i."' selected='true'>".$i."</option>";
		}
		else
		{
			$minutes.="<option value='".$i."'>".$i."</option>";
		}
	}
	$source= empty($_REQUEST['source'])?'AIR PORT ROAD':$_REQUEST['source'];
	$destination= empty($_REQUEST['destination'])?'EGL':$_REQUEST['destination'];

	$sql="select COMMUTER_ID, lname as commutername,srclandmark,dstlandmark,source,destination,city from commuter where source like '%".$source."%' AND destination like '%".$destination."%'";
	foreach ($conn->query($sql) as $row) 
	{
		$existinglist[]=$row;	
	}	
	//$existinglist=array(array('commutorid'=>'123','commutername'=>'Manmada Reddy','fromaddress'=>"bellandur, Bangalore",'toaddress'=>'yahoo,eglbp,bangalore'),array('commutorid'=>'124','commutername'=>'Bhaskar','fromaddress'=>"4th main,girinagar",'toaddress'=>'yahoo,eglbp,bangalore'));
?>
<div style='font-size:12px;'>Select the commuters and send them the <B>commute solution</B> with <B>subscription fee</B> details.</div>
<table cellpadding=0 cellspacing=0 class='tblclass' >
<tr>
	<td>
	<form method='post' action='vendors.php'>
		<table cellpadding=0 cellspacing=0 width='70%'>
		<tr>
			<td>From</td>
			<td>To</td>
			<td>Time</td>
		</tr>
		<tr>
			<td><select name='source' id='source' class='formfield'>
				<?php getlocalAreas($source);?>
				</select>
			</td>
			<td>
				<select name='destination' id='destination' class='formfield'>
				<?php getlocalAreas($destination);?>
				</select>
			</td>
			<td><select name='hours' class='selectfield'>
				<?php echo $hoursstr;?>
				</select>&nbsp;<select name='minutes' class='selectfield'>
				<?php echo $minutes;?>
				</select></td>
		</tr>
		<tr><td colspan=3>&nbsp;</td></tr>
		<tr>
			<td><input type='radio' name='triptype' value='roundtrip' checked='true'>Round Trip
			</td>
			<td>
				<input type='radio' name='triptype' value='oneway'>One Way
			</td>
			<td><FONT SIZE="" COLOR=""></FONT></td>
		</tr>
			<tr><td colspan=3>&nbsp;</td></tr>	
		<tr>
			<td><input type='submit' class='btn_pri_125' value='Search'/>
			</td>
			<td><input type='button' class='btn_pri_125' value='View Route Map' onclick="viewmap();"/></td>
			<td>&nbsp;</td>
		</tr>
		</table>
		</form>
	</td>
</tr>
<form method='post' action='send_quote.php'>
<tr>
	<td>
	<div>List of Commuters</div>

	<table cellpadding=0 cellspacing=0 width='70%'>
	<tr>
		<th>Name</th>
		<th>From Address</th>
		<th>To Address</th>
		<th>Action</th>
	</tr>
	<?php 
		if(count($existinglist)>0)
		{
			foreach($existinglist as $existing)
			{
				echo "<tr><td><input type='checkbox' name='commutorid[]' value='".$existing['COMMUTER_ID']."' >".$existing['commutername']."</td><td>".$existing['srclandmark'].', '.$existing['source']."</td><td>".$existing['dstlandmark'].', '.$existing['destination']."</td><td><a href=\"javascript:viewpoint('".urlencode($existing['srclandmark'].','.$existing['source'].', '.$existing['city'])."');\">view point</a></td></tr>";
				echo "<tr><td colspan=4><hr/></td></tr>";
			}
			echo "<tr><th colspan=4><input type='checkbox'>&nbsp;Select All</th></tr>";
		}
		else
		{
		echo "<tr><td colspan=4 align=center><font style='color:#ff0000'><b>No existing records found.</b></font></td></tr>";
		}
		echo "<tr><td colspan=4>&nbsp;</td></tr>";
	?>
	<tr>
		<td><b>Monthly</b></td>
		<td><b>Quarterly</b></td>
		<td><b>Half Yearly</b></td>
	</tr>
	<tr>
		<td><input type='text' class='formfield' name='monthly' maxlength='5'></td>
		<td><input type='text' class='formfield' name='quarterly' maxlength='5'></td>
		<td><input type='text' class='formfield' name='halfyearly' maxlength='5'></td>
	</tr>
	<tr><td colspan=3>&nbsp;</td></tr>
	</table>
	</td>
</tr>
<tr><td><input type='submit' class='btn_pri_125' value='Send Prices'/>&nbsp;</td></tr>
</form>
</table>

<?php
	display_footer();
?>
			