<?php
include("common.inc");
$errormsg='';
if($_REQUEST['choice']=='login')
{
	if(is_valid_commuter())
	{
		header('Location:commuters.php');
	}
	else
	{
		$errormsg='Invalid Email and Password.';
	}
}
display_header();
$message='Commuter Login';
echo "<div style='font-size:12px;color:#20941c'><B>".$message."</B></div>";
if($errormsg)
{
	echo "<div style='font-size:10px;color:#ff0000'><B>".$errormsg."</B></div>";
}
?>
<form method='post' action='commuter_login.php' >
<table cellpadding=0 cellspacing=0 class='tblclass' style='width:80%'>
<tr>
	<td>
		<table cellpadding=5 cellspacing=0 >
		<tr>
			<td>Email</td>
			<td><input type='text' name='email' class='inpfield'></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type='password' name='password' class='inpfield'></td>
		</tr>
		<tr>
			<td colspan=2><input type='submit' class='btn_pri_125' value='Login'/></td>
		</tr>
		</table>
		<input type='hidden' name='choice' value='login'><span class="class2" style='margin-left:160px;'><a  class='actionlink' href='newcommuters.php'>Register</a><b class='seperator'>|</b><a  class='actionlink' href='#'>Forgot Password?</a></span>
	</td>
</tr>
</table>
</form>
<?php
	display_footer();
?>
			