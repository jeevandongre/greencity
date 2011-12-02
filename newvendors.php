<?php
	include("common.inc");
	display_header();
?>
<div style='font-size:12px;'><B>New Vendor Registration</B></div>
<form method='post' action='vendor_register.php' onsubmit="return validateform('inpfield');">
<div><em>*</em>=Required</div>
<table cellpadding=0 cellspacing=0 class='tblclass' style='width:80%'>
<tr>
	<td>
		<table cellpadding=5 cellspacing=0 >
		<tr>
			<td>Company Name<em>*</em></td>
			<td><input type='text' name='company' hh_validate_function='string_required' hh_validate_msg='Please enter your company name' class='inpfield'></td>
		</tr>
		<tr>
			<td>Contact Person<em>*</em></td>
			<td><input type='text' name='fullname' class='inpfield' hh_validate_function='string_required' hh_validate_msg='Please enter your contact person name'></td>
		</tr>
		<tr>
			<td>Email<em>*</em></td>
			<td><input type='text' name='email' class='inpfield' hh_validate_function='email_required' hh_validate_msg='Please enter your comapny valid email'></td>
		</tr>
		<tr>
			<td>Phone<em>*</em></td>
			<td><input type='text' name='phone' class='inpfield' hh_validate_function='number_required' hh_validate_msg='Please enter your company valid phone number'></td>
		</tr>		
		</table>
	</td>
	<td valign='top'><table cellpadding=5 cellspacing=0 >
		<tr>
			<td>Address<em>*</em></td>
			<td><input type='text' name='address' class='inpfield' hh_validate_function='string_required' hh_validate_msg='Please enter your company address'></td>
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
		</table></td>
</tr>
<tr><td colspan=3>&nbsp;</td></tr>	
<tr><td colspan=3><input type='submit' class='btn_pri_125' value='Register' /></td></tr>
</table>
</form>
<?php
	display_footer();
?>
			