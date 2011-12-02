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
	$pkgarr=array('','Monthly','Quarterly','HalfYearly');
	$pkgopt =getOptionsString($pkgarr);
	$source= empty($_REQUEST['source'])?'Koramangala':$_REQUEST['source'];
	$destination= empty($_REQUEST['destination'])?'MG Road':$_REQUEST['destination'];
	$roundtrip='';
	$oneway='';
	if($_REQUEST['triptype']=='roundtrip')
	{
		$triptype= '1';
		$roundtrip='checked=true';
		$sql="SELECT a.vender_id,b.route_id, a.company, c.src_name, c.dest_name, c.city, c.state, d.Monthly, d.Quarterly, d.Half_Yearly FROM vender a, vender_routes b, route c, package_type d WHERE a.vender_id = b.vender_id AND b.route_id = c.route_id	AND b.package_id = d.pkg_id and c.src_name = '".$source."' AND c.dest_name = '".$destination."' and f_round = '1'";
	}
	else
	{
		$triptype= '0';
		$oneway='checked=true';
		$sql="SELECT a.vender_id,b.route_id, a.company, c.src_name, c.dest_name, c.city, c.state, d.Monthly, d.Quarterly, d.Half_Yearly 	FROM vender a, vender_routes b, route c, package_type d WHERE a.vender_id = b.vender_id AND b.route_id = c.route_id AND b.package_id = d.pkg_id and c.src_name = '".$source."' AND c.dest_name = '".$destination."' and f_round = '0'";
	}
//	echo $sql;
	foreach ($conn->query($sql) as $row) 
	{
		$existinglist[]=$row;	
	}	
//	print_R($existinglist);
	//$existinglist=array(array('vendorid'=>'123','vendorname'=>'SRK Travels','monthly'=>450,'quarterly'=>1200,'half'=>2200),array('vendorid'=>'124','vendorname'=>'ABT Travels','monthly'=>470,'quarterly'=>1300,'half'=>2500));
?>
<div style='font-size:12px;'>Select one of the <B>Existing commute package solution</B> and submit, Selected vendor will be in touch with you. You can also <B>Request</B> for <b>new</b>.</div>

<table cellpadding=0 cellspacing=0 class='tblclass' >
<tr>
	<td>
	<form method='post' action='commuters.php'>
		<table cellpadding=0 cellspacing=0 width='60%'>
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
			<td><input type='radio' name='triptype' value='roundtrip' <?php echo $roundtrip;?>>Round Trip
			</td>
			<td>
				<input type='radio' name='triptype' value='oneway'  <?php echo $oneway;?>>One Way
			</td>
			<td>&nbsp;</td>
		</tr>
			<tr><td colspan=3>&nbsp;</td></tr>
	<!---	<tr>
			<td>Package</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td><select name='package' class='formfield'>
				<?php echo $pkgopt;?>
				</select>
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr><td colspan=3>&nbsp;</td></tr>-->
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
<tr>
	<td>
	<form method='post' action='commute_subscribe.php?mode=exist'>
	<table cellpadding=0 cellspacing=0 width='70%'>
	<tr>
		<th>Travel Vendors</th>
		<th>Monthly</th>
		<th>Quarterly</th>
		<th>Half yearly</th>
	</tr>
	<?php 
		if(count($existinglist)>0)
		{
			foreach($existinglist as $existing)
			{
				echo "<tr><td><input type='radio' name='vendorid_routeid' value='".$existing['vender_id'].'_'.$existing['route_id']."' >".$existing['company']."</td><td>".$existing['Monthly']."$currency</td><td>".$existing['Quarterly']."$currency</td><td>".$existing['Half_Yearly']."$currency</td></tr>";
				echo "<tr><td colspan=4><hr/></td></tr>";
			}
			echo "<tr><td colspan=4>Package:&nbsp;<select name='package' class='formfield'>
				<?php echo $pkgopt;?>
				</select></td></tr>";
		}
		else
		{
		echo "<tr><td colspan=4 align=center><font style='color:#ff0000'><b>No existing records found. Please fill the below form for new request.</b></font></td></tr>";
		}
		echo "<tr><td colspan=4>&nbsp;</td></tr>";
	?>
	</table>
	</td>
</tr>
<?php if(count($existinglist)>0)
{?>
<input type='hidden' name='f_round' value='<?php echo $triptype;?>'>
<input type='hidden' name='source' value='<?php echo $source;?>'>
<input type='hidden' name='destination' value='<?php echo $destination;?>'>
<tr><td><input type='submit' class='btn_pri_125' value='Subscribe'/></td></tr>
<?php }?>
</table>
</form>
<div style='font-size:12px;padding-top:10px;'>Request for <B>new source,destination</B>. Vendors will comeup with suitable package for you in short duration.</div>
<form method='post' action='commute_subscribe.php?mode=new'>
<table cellpadding=0 cellspacing=0 class='tblclass' >
<tr>
	<td>
		<table cellpadding=0 cellspacing=0 width='50%'>
		<tr>
			<td>From</td>
			<td>To</td>
			<td>Time</td>
		</tr>
		<tr>
			<td><select name='source' class='formfield'>
				<?php getlocalAreas();?>
				</select>
			</td>
			<td>
				<select name='destination' class='formfield'>
					<?php getlocalAreas('EGL');?>
				</select>
			</td>
			<td><select name='hours' class='selectfield'>
				<?php echo $hoursstr;?>
				</select>&nbsp;<select name='minitues' class='selectfield'>
				<?php echo $minutes;?>
				</select></td>
		</tr>
		<tr><td colspan=3>&nbsp;</td></tr>
		<tr>
			<td><input type='radio' name='triptype' value='roundtrip' >Round Trip
			</td>
			<td>
				<input type='radio' name='triptype' value='oneway' checked='true'>One Way
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr><td colspan=3>&nbsp;</td></tr>
		<tr><td colspan=3>If not in list, enter the landmark and address</td></tr>
		<tr><td colspan=3>&nbsp;</td></tr>
		<tr><td colspan=3>
		<table cellpadding=0 cellspacing=0 width='100%'>
		<tr>
			<td>From landmark</td>
			<td><input type='text' name='srclandmark' maxlength='50'></td>
			<td>To landmark</td>
			<td><input type='text' name='dstlandmark' maxlength='50'></td>
		</tr>
		<tr>
			<td>From address</td>
			<td><textarea name='from_address'></textarea></td>
			<td>To address</td>
			<td><textarea name='to_address'></textarea></td>
		</tr>
		</table>		
		</td></tr>
		<tr><td colspan=3>&nbsp;</td></tr>
		<tr>
			<td><input type='radio' name='nodays' value='6' >6 days in a week
			</td>
			<td>
				<input type='radio' name='nodays' value='5' checked='true'>5 days in a week
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr><td colspan=3>&nbsp;</td></tr>
		</table>
	</td>
</tr>
<tr>
	<td>
	
	</td>
</tr>
<tr><td><input type='submit' class='btn_pri_125' value='Send Request'/></td></tr>
</table>
</form>
<?php
	display_footer();
?>
			