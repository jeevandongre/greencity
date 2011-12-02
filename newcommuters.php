<?php
	include("common.inc");
	display_header();
?>
<div style='font-size:12px;'><B>New Commuter Registration</B></div>
<form method='post' action='commuter_register.php' onsubmit="return validateform('inpfield');">
<div><em>*</em>=Required</div>
<table cellpadding=0 cellspacing=0 class='tblclass' style='width:80%'>
<tr>
	<td>
		<table cellpadding=5 cellspacing=0 >
		<tr>
			<td>First Name<em>*</em></td>
			<td><input type='text' name='fname' class='inpfield' hh_validate_function='string_required' hh_validate_msg='Please enter your first name'></td>
		</tr>
		<tr>
			<td>Last Name<em>*</em></td>
			<td><input type='text' name='lname' class='inpfield' hh_validate_function='string_required' hh_validate_msg='Please enter your last name'></td>
		</tr>
				<tr>
			<td>Company Name<em>*</em></td>
			<td><input type='text' name='company' hh_validate_function='string_required' hh_validate_msg='Please enter your company name' class='inpfield'></td>
		</tr>
		<tr>
			<td>Job Title<em>*</em></td>
			<td><input type='text' name='title' class='inpfield' hh_validate_function='string_required' hh_validate_msg='Please enter your Job Title'></td>
		</tr>
		<tr>
			<td>Email<em>*</em></td>
			<td><input type='text' name='email' class='inpfield' hh_validate_function='email_required' hh_validate_msg='Please enter your valid email'></td>
		</tr>
		<tr>
			<td>Source landmark<em>*</em></td>
			<td><input type='text' name='srclandmark' class='inpfield' hh_validate_function='string_required' hh_validate_msg='Please enter your source landmark'></td>
		</tr>			
		</table>
	</td>
	<td valign='top'><table cellpadding=5 cellspacing=0 >
	<tr>
			<td>Phone<em>*</em></td>
			<td><input type='text' name='phone' class='inpfield' hh_validate_function='number_required' hh_validate_msg='Please enter your  phone number'></td>
		</tr>	
		<tr>
			<td>Address<em>*</em></td>
			<td><input type='text' name='address' class='inpfield' hh_validate_function='string_required' hh_validate_msg='Please enter your address'></td>
		</tr>
		<tr>
			<td>City<em>*</em></td>
			<td><input type='text' name='city' class='inpfield' hh_validate_function='string_required' hh_validate_msg='Please enter your city'></td>
		</tr>
		<tr>
			<td>State<em>*</em></td>
			<td><input type='text' name='state' class='inpfield' hh_validate_function='string_required' hh_validate_msg='Please enter your state'></td>
		</tr>
		<tr>
			<td>Pin<em>*</em></td>
			<td><input type='text' name='pincode' class='inpfield' hh_validate_function='number_required' hh_validate_msg='Please enter your pincode'></td>
		</tr>
		
		<tr>
			<td>Destination landmark<em>*</em></td>
			<td><input type='text' name='dstlandmark' class='inpfield' hh_validate_function='string_required' hh_validate_msg='Please enter your destination'></td>
		</tr>
		</table></td>
</tr>
<tr><td colspan=3>&nbsp;</td></tr>	
<tr><td colspan=3><input type='submit' class='btn_pri_125' value='Register' /></td></tr>
</table>
</form>
<?php
	display_footer();
?>
			