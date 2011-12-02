<?php
session_start();
include('connection.php');
$conn=dbconnection('root','','commute');
$vendor_form_fields=array('company','fullname','email','phone','address','city','state','pincode');
$commuter_form_fields=array('company','fname','lname','title','email','phone','address','city','state','pincode','srclandmark','dstlandmark');
$currency=' INR';
function display_header()
{
	$logout='';
	$links="";
	if($_SESSION['loggedin']==1)
	{	
		if(!empty($_SESSION['COMMUTER_ID']))
		{
			$links="<a class='actionlink' href='commuters.php'>Travel Vendor Search</a>";			
		}
		else
		{
			$links="<a class='actionlink' href='vendors.php'>Commuter Search</a>";
		}
		$links .="<b class='seperator'>|</b><a class='actionlink' href='index.php'>how it works</a>";			
		$links.="<b class='seperator'>|</b><a class='actionlink' href='signout.php'>Logout</a>";
	}
	else
	{
		$links="<a class='actionlink' href='newcommuters.php'>New Commuters</a><b class='seperator'>|</b><a class='actionlink' href='newvendors.php'>New Vendors</a><b class='seperator'>|</b><a class='actionlink' href='commuter_login.php'>Commuter Login</a><b class='seperator'>|</b><a class='actionlink' href='vendor_login.php'>Vendor Login</a>";
	}
echo <<<EOD
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>Y! Green City</title>
<meta name="generator" content="editplus">
<meta name="author" content="">
<meta name="keywords" content="">
<meta name="description" content="">
<link href='greencity.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src='js/yahoo.js'></script>
<script type="text/javascript" src='js/dom.js'></script>
<script type="text/javascript" src='js/event.js'></script>
<script type="text/javascript" src='js/utilities.js'></script>
<script type="text/javascript" src='js/jscript.js'></script>
<script type="text/javascript" src='js/error_validation.js'></script>
</head>
<body>
<center>
	<div id="container" >
		<br/>
		<table width='750' cellpadding=0 cellspacing=0 style='border:1px solid #cccccc' align='center'>
		<tr>
			<td valign='top'>
				<table cellpadding=0 cellspacing=0 border=0>
				<tr><td valign='top' style='background-color:#20941c;'><a href='index.php'><img src='images/logo.gif' border=0></a></td><td align='right' valign='bottom' style='background-color:#20941c;'><span class="class1">$links</span></td></tr>
				<tr><td valign='top' style='background-color:#ffffff'><img src='images/img1.jpg'></td><td><img src='images/img2.jpg'></td></tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign='top' style='background-color:#ffffff;'>
				<table cellpadding=0 cellspacing=0 border=0  width='100%' style='padding:10px;'>
				<tr><td valign='top'>
EOD;
}
function display_footer()
{
echo <<<EOD
</td></tr>
				<tr><td valign='bottom' class='footer'><br/><hr/>Copyright 2008 Yahoo Web Services India Pvt Ltd. All rights reserved.<br/>
				Privacy Policy - Terms of Service - Copyright Notice
				</td></tr>
				</table>
			</td>
		</tr>		
		</table>
		</div>
</center>
</body>
</html>
EOD;
}
function insert_record($conn,$sql)
{
	try
	{
		$conn->beginTransaction();
		$conn->exec($sql);
		$conn->commit();
	}catch (PDOException $e) {
	   $conn->rollBack();
	   print "Error!: " . $e->getMessage() . "<br/>";
	   die();
	}
}
function is_valid_commuter()
{
	global $conn;
	$stmt = $conn->query("select count(COMMUTER_ID) as cnt,COMMUTER_ID from commuter where email='".$_REQUEST['email']."' and Pass='".$_REQUEST['password']."' group by COMMUTER_ID");
	$result = $stmt->fetch();

	if($result['cnt']==1)
	{
		$_SESSION['COMMUTER_ID']=$result['COMMUTER_ID'];
		$_SESSION['loggedin']=1;
		return true;
	}
	else
	{
		return false;
	}
}
function is_valid_vendor()
{	
	global $conn;
	$stmt = $conn->query("select count(VENDER_ID) as cnt,VENDER_ID from vender where email='".$_REQUEST['email']."' and Pass='".$_REQUEST['password']."' group by VENDER_ID");
	$result = $stmt->fetch();
	if($result['cnt']==1)
	{
		$_SESSION['VENDER_ID']=$result['VENDER_ID'];
		$_SESSION['loggedin']=1;
		return true;
	}
	else
	{
		return false;
	}
}
//for predefined fields array it will set the form values
function setfields($form_fields,$request)
{
    $temparr=array();
    foreach($form_fields as $fields)
    {
        if(isset($request[$fields]))
		{
			$temparr[$fields]=htmlspecialchars($request[$fields],ENT_QUOTES);
		}		
    }
    return $temparr;
}
function check_login()
{
	if($_SESSION['loggedin']==1)
	{
		if(!empty($_SESSION['VENDER_ID']))
		{
			header('Location:vendors.php');
		}
		elseif(!empty($_SESSION['COMMUTER_ID']))
		{
			header('Location:commuters.php');
		}
	}
}
//for any options array it will give options string
function getOptionsString($optionsarr,$checked='',$use_value_as_key=0)
{
    $optstr='';
    foreach($optionsarr as $key=>$val)
    {
        if($use_value_as_key)$key=$val;
        if($key==$checked)
        {
            $optstr.="<option value='".$key."' selected=true>".$val."</option>";
        }
        else
        {
            $optstr.="<option value='".$key."'>".$val."</option>";
        }
    }
    return $optstr;
}
function getlocalAreas($selectedloc='')
{
	$locations=array("AIR PORT ROAD","Banashankari 3rd Stg","Bannerghatta Road","Bannerghatta Road","Basava nagar","BSK 3rd stage","BTM  Layout 1st stage","BTM  Layout 2nd stage","BTM Layout","BTM Layout 2nd stage","Chandra Layout","Domlur","EGL","Habbal","Hongasandra Begur road","HSR Layout","Indira nagar 3rd Stg","J P nagar 6th phase","Jayanagar 9th Blk","JP nagar 15th Cross","JP nagar 1st  phase","Kaggadasapura","Kemp fort","Koramangala","MAHALAKSHMI LAYOUT","Marath Halli","Marathalli","Maruthi Nagar","Maruthi nagar Madivala","Mathikere","MG Road","Padmanabha Nagar");
	echo getOptionsString($locations,$selectedloc,1);
//echo '<option value="Adugodi">Adugodi</option><option value="Agaram">Agaram</option><option value="Airport Road">Airport Road</option><option value="Anjanapura">Anjanapura</option><option value="Arabic College">Arabic College</option><option value="Banashankari All Stages">Banashankari All Stages</option><option value="Banasvadi">Banasvadi</option><option value="Banaswadi">Banaswadi</option><option value="Bangalore City">Bangalore City</option><option value="Bangalore GPO ">Bangalore GPO </option><option value="Bangalore Viswavidyalaya">Bangalore Viswavidyalaya</option><option value="Bannerghatta">Bannerghatta</option><option value="Bannerghatta Road">Bannerghatta Road</option><option value="Basavanagudi">Basavanagudi</option><option value="Basaveshwar Nagar">Basaveshwar Nagar</option><option value="Benson Town">Benson Town</option><option value="Brigade Road">Brigade Road</option><option value="BTM 1st Stage">BTM 1st Stage</option><option value="BTM-Layouts">BTM-Layouts</option><option value="Byappanahalli">Byappanahalli</option><option value="Byatarayanapura">Byatarayanapura</option><option value="Byrasandra ">Byrasandra </option><option value="Cambridge Layout">Cambridge Layout</option><option value="Cambridge Lty">Cambridge Lty</option><option value="Carmelaram">Carmelaram</option><option value="Chamarajpet & Mysore Road">Chamarajpet & Mysore Road</option><option value="Chamundeshwari Layout">Chamundeshwari Layout</option><option value="Chandra Layout">Chandra Layout</option><option value="Chickpet">Chickpet</option><option value="Chikkabanaswadi">Chikkabanaswadi</option><option value="Chikkabanavara">Chikkabanavara</option><option value="Cholanayakkanahilli">Cholanayakkanahilli</option><option value="Chunchghatta">Chunchghatta</option><option value="City Market & Old City Area">City Market & Old City Area</option><option value="Commercial Street">Commercial Street</option><option value="Cooke Town">Cooke Town</option><option value="Cox Town">Cox Town</option><option value="Cunningham Road">Cunningham Road</option><option value="Dasarahalli">Dasarahalli</option><option value="Devanahalli">Devanahalli</option><option value="Devarachikkanahalli">Devarachikkanahalli</option><option value="Devasandra">Devasandra</option><option value="Dharmaram College">Dharmaram College</option><option value="Dodda Banaswadi">Dodda Banaswadi</option><option value="Dodda Bomasandra">Dodda Bomasandra</option><option value="Doddakallasandra">Doddakallasandra</option><option value="Domlur">Domlur</option><option value="Dooravaninagar">Dooravaninagar</option><option value="EGL">EGL</option><option value="Ejipura">Ejipura</option><option value="Electronic City">Electronic City</option><option value="Frazer Town">Frazer Town</option><option value="G.E.F.">G.E.F.</option><option value="G.K.V.K.">G.K.V.K.</option><option value="Gandhinagar & Majestic Area">Gandhinagar & Majestic Area</option><option value="Ganga Nagar">Ganga Nagar</option><option value="Gavipuram Extension">Gavipuram Extension</option><option value="H.M.T">H.M.T</option><option value="HAL Layout">HAL Layout</option><option value="Hebbal Agrl Farm">Hebbal Agrl Farm</option><option value="Hesaraghatta">Hesaraghatta</option><option value="Hesaraghatta Lake">Hesaraghatta Lake</option><option value="HSR Layouts">HSR Layouts</option><option value="Indira Nagar">Indira Nagar</option><option value="Industrial Estate">Industrial Estate</option><option value="Infantry Road">Infantry Road</option><option value="J C Nagar">J C Nagar</option><option value="J.P.Nagar Layouts">J.P.Nagar Layouts</option><option value="Jalahalli">Jalahalli</option><option value="Jalahalli East">Jalahalli East</option><option value="Jalahalli West">Jalahalli West</option><option value="Jayanagar All Block">Jayanagar All Block</option><option value="K H B Road">K H B Road</option><option value="K R Puram">K R Puram</option><option value="Kadugodi">Kadugodi</option><option value="Kalyan Nagar">Kalyan Nagar</option><option value="Kammanahalli">Kammanahalli</option><option value="Kanakapura Road">Kanakapura Road</option><option value="Kasturba Road">Kasturba Road</option><option value="kasturi Nagar">kasturi Nagar</option><option value="Katriguppe">Katriguppe</option><option value="Kavalbyrasandra">Kavalbyrasandra</option><option value="KEB Layout">KEB Layout</option><option value="Kempaura">Kempaura</option><option value="Kengeri">Kengeri</option><option value="Konankunte">Konankunte</option><option value="Koramangala Layouts">Koramangala Layouts</option><option value="Kothanur">Kothanur</option><option value="Krishnarajapuram">Krishnarajapuram</option><option value="Kumaraswamy Layout">Kumaraswamy Layout</option><option value="Kumbalgodu">Kumbalgodu</option><option value="L B Road">L B Road</option><option value="Lavelle Road">Lavelle Road</option><option value="Lingaraj Puram">Lingaraj Puram</option><option value="MG Road">MG Road</option><option value="Madivala">Madivala</option><option value="Madras Bank Road">Madras Bank Road</option><option value="Magadi Road">Magadi Road</option><option value="Mahadevapura">Mahadevapura</option><option value="Mahalakshmipuram Layout">Mahalakshmipuram Layout</option><option value="Malleshwaram">Malleshwaram</option><option value="Marathahalli">Marathahalli</option><option value="Marathahalli Colony">Marathahalli Colony</option><option value="Maruthisevanagar">Maruthisevanagar</option><option value="Mathikere">Mathikere</option><option value="Murugesh Palya">Murugesh Palya</option><option value="Mysore Road">Mysore Road</option><option value="Nagarabhavi">Nagarabhavi</option><option value="Nagarvar Kari">Nagarvar Kari</option><option value="Nagasandra">Nagasandra</option><option value="Nandhini Layout">Nandhini Layout</option><option value="Nandidurg Road">Nandidurg Road</option><option value="Nayandahalli">Nayandahalli</option><option value="Nelamangala">Nelamangala</option><option value="New Tippasandra">New Tippasandra</option><option value="Old Madras Road">Old Madras Road</option><option value="Padmanabhanagar">Padmanabhanagar</option><option value="Peenya S.I.">Peenya S.I.</option><option value="Queens Road">Queens Road</option><option value="R V Niketan">R V Niketan</option><option value="R.M.V. Extension">R.M.V. Extension</option><option value="R.T.Nagar">R.T.Nagar</option><option value="Rajaji Nagar">Rajaji Nagar</option><option value="Rajarajeshwari Nagar">Rajarajeshwari Nagar</option><option value="Rammurthy Nagar">Rammurthy Nagar</option><option value="Residency Road">Residency Road</option><option value="Richards Town">Richards Town</option><option value="Richmond Town">Richmond Town</option><option value="RPC Layout">RPC Layout</option><option value="Sadashiv Nagar">Sadashiv Nagar</option><option value="Sanjay Nagar">Sanjay Nagar</option><option value="Sarjapura">Sarjapura</option><option value="Science Institute">Science Institute</option><option value="Seshadripuram">Seshadripuram</option><option value="Shanti Nagar">Shanti Nagar</option><option value="Shastri Nagar">Shastri Nagar</option><option value="Shivaji Nagar">Shivaji Nagar</option><option value="Sivanchetty Garden">Sivanchetty Garden</option><option value="Srirampuram">Srirampuram</option><option value="St. Thomas Town">St. Thomas Town</option><option value="St.Marks Road">St.Marks Road</option><option value="Subramanyapura">Subramanyapura</option><option value="Telecom Layouts">Telecom Layouts</option><option value="Thyagarajanagar">Thyagarajanagar</option><option value="Tumkur Road">Tumkur Road</option><option value="Ulsoor Layout">Ulsoor Layout</option><option value="Varthur">Varthur</option><option value="Vasant Nagar">Vasant Nagar</option><option value="Vijay Nagar">Vijay Nagar</option><option value="Vimanapura">Vimanapura</option><option value="Virgonagar">Virgonagar</option><option value="Visveshwarapuram">Visveshwarapuram</option><option value="Viswaneedam">Viswaneedam</option><option value="Viveknagar">Viveknagar</option><option value="White Field">White Field</option><option value="Wilson Garden">Wilson Garden</option><option value="Yelahanka">Yelahanka</option><option value="Yeswanthpur">Yeswanthpur</option>';
}
?>