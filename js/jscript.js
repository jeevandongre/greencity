currentNodeBeingValidated='';
//form validation function
function validateform(ValidationTag)
{
	if(ValidationTag != null&&typeof ValidationTag != 'undefined'&&ValidationTag !='')
	{
		var arrInp = YAHOO.util.Dom.getElementsByClassName(ValidationTag);
	}
	else
	{
		var arrInp = YAHOO.util.Dom.getElementsByClassName('validate_me');
	}
	var j=0;
	for(var i=0; i<arrInp.length; i++)
	{
		obj = arrInp[i];
		currentNodeBeingValidated=obj;
		var result=eval(obj.getAttribute("hh_validate_function")+"("+")");	
		if(result)
		{
				try
				{
					if(j==0)
					{
						var firstErrInp =obj;				
					}j++;
				}catch(e){};
				pageHasErrors="1";
		}
	}	
	if(firstErrInp != null&&typeof firstErrInp != 'undefined'&&firstErrInp !='')
	{
		try{
			firstErrInp.focus;
			setMessage(firstErrInp);
			firstErrInp.select();
		}catch(e){}
		return false;
	}
	return true;
}
//error message popup setting
function setMessage(obj){
	msg=obj.getAttribute("hh_validate_msg");
	alert(msg);
}

function hideErrorPopup(e){
	YAHOO.util.Dom.setStyle("err_msg", "display", "none");
	YAHOO.util.Dom.replaceClass(this, "focus_inp_error", "inp"); // unhighlights the moused over item (?yellow bkg)

//	if(this.id=="jdescerr") YAHOO.util.Dom.replaceClass("c_errdesc", "err_box_focus", "err_box");
//	else
//		YAHOO.util.Dom.replaceClass(this.parentNode, "err_box_focus", "err_box");
	
	YAHOO.util.Dom.replaceClass(this.parentNode, "err_box_focus", "err_box");
}
function showErrorPopup(e){
	var reg = YAHOO.util.Dom.getRegion(this.parentNode);
	YAHOO.util.Dom.replaceClass(this, "inp", "focus_inp_error");
	YAHOO.util.Dom.replaceClass(this.parentNode, "err_box", "err_box_focus");

	YAHOO.util.Dom.setStyle("err_msg", "display", "block");
	YAHOO.util.Dom.setY("err_msg", reg.top - 4);
	YAHOO.util.Dom.setX("err_msg", (reg.right + 9));
	setMessage(this);
}
function TrimString(sInString)
{'parent:nomunge';if(typeof sInString=="undefined")
{return"";}
sInString=sInString.replace(/^\s+/g,"");return sInString.replace(/\s+$/g,"");}

function viewmap()
{
	var q='';
	q = "from "+$('source').options[$('source').selectedIndex].text+', Bangalore';
	q +=" to "+$('destination').options[$('destination').selectedIndex].text+', Bangalore';
	var url="display_map.php?q="+encodeURI(q);
	window.open(url,"","toolbar=no, location=no, directories=no, status=no, menubar=no,left=430,top=80,scrollbars=no, resizable=no, width=850, height=800");
}
function $(id)
{
	return document.getElementById(id);
}

function viewpoint(frmaddr)
{
	var url="display_map.php?q="+encodeURI(frmaddr);
	window.open(url,"","toolbar=no, location=no, directories=no, status=no, menubar=no,left=430,top=80,scrollbars=no, resizable=no, width=850, height=800");
}