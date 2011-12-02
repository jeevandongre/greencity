
var whatClass;var count;var currentNodeBeingValidated;var pageHasErrors=0;var gnarleyTestContent="";var MAX_SALARY_LIMIT=9999999.9999;function HTMLEditor_required(){if(currentNodeBeingValidated.value==""){return true;}else if(currentNodeBeingValidated.value=="AA=="){return true;}else if(currentNodeBeingValidated.value==default_text){return true;}else{return false;}}
function email_notrequired(){if(TrimString(currentNodeBeingValidated.value)==""){return false;}else{var emailPattern=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;if(emailPattern.test(TrimString(currentNodeBeingValidated.value)))
{return false;}
else
{return true;}}}
function recipient_required(){if(currentNodeBeingValidated.value==""){return true;}else{var multiRecipients=currentNodeBeingValidated.value.split(',');var emailPattern=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;for(var i=0;i<multiRecipients.length;i++)
{if(emailPattern.test(TrimString(multiRecipients[i])))
{}
else
{return true;}}}}
function email_required(){if(TrimString(currentNodeBeingValidated.value)==""){return true;}else{var emailPattern=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;if(emailPattern.test(TrimString(currentNodeBeingValidated.value)))
{return false;}
else
{return true;}}}
function number_required(){if(TrimString(currentNodeBeingValidated.value)==""){return true;}else{pattern=/^[0-9]*$/;if(pattern.test(TrimString(currentNodeBeingValidated.value))==false){return true;}else{return false;}}}
function number_notrequired(){if(TrimString(currentNodeBeingValidated.value)==""){return false;}else{pattern=/^[0-9]*$/;if(pattern.test(TrimString(currentNodeBeingValidated.value))==false){return true;}else{return false;}}}
function numberWithDot_notrequired(){if(TrimString(currentNodeBeingValidated.value)==""){return false;}else{pattern=/^[0-9]*.[0-9]*$/;if(pattern.test(TrimString(currentNodeBeingValidated.value))==false){return true;}else{return false;}}}
function numberWithDot_notrequired_withsalvalidate(){if(TrimString(currentNodeBeingValidated.value)==""){if(document.getElementById(currentNodeBeingValidated.getAttribute('hh_validate_msg')).style.display=="")
{return true;}
else
{return false;}}else{pattern=/^[0-9]*.[0-9]*$/;document.getElementById('JOB_SALARY_MSG').innerHTML="These fields must be numbers";if((pattern.test(TrimString(currentNodeBeingValidated.value)))==false||(document.getElementById(currentNodeBeingValidated.getAttribute('hh_validate_msg')).style.display=="")){return true;}else{var ret;ret=validate_max_min_salary(document.getElementById('MIN_SALARY').value,currentNodeBeingValidated.value);if(ret==2){document.getElementById('JOB_SALARY_MSG').innerHTML="The maximum base salary must be greater than or equal to the minimum";return true;}else if(ret==1){document.getElementById('JOB_SALARY_MSG').innerHTML="Both minimun and maximum salary should be less than "+MAX_SALARY_LIMIT;return true;}else{return false;}}}}
function validate_max_min_salary(min,max){var minsal=parseFloat(min);var maxsal=parseFloat(max);if(min!=""&&max!=""){if(minsal>MAX_SALARY_LIMIT||maxsal>MAX_SALARY_LIMIT){return 1;}else if(minsal>maxsal){return 2;}else{return 0;}}
return 0;}
function salary_notrequired(){if(TrimString(currentNodeBeingValidated.value)==""){return false;}else{pattern=/^((\d+(,\d{1,3})*(\.\d*)?))$/;if(pattern.test(TrimString(currentNodeBeingValidated.value))==false){return true;}else{return false;}}}
function dropdown_required(){if(currentNodeBeingValidated.value==""){return true;}else{return false;};}
function string_required(){if(TrimString(currentNodeBeingValidated.value)==""){return true;}else{var str=currentNodeBeingValidated.value;var i=0;for(i=0;i<str.length;i++)
{if(str.charCodeAt(i)>32)
{return false;}}
return true;}}
function city_required(){if(TrimString(currentNodeBeingValidated.value)==""||TrimString(currentNodeBeingValidated.value)=="- City -"){return true;}else{return false;}}
function startValidatingForm(beginningNode){pageHasErrors="0";validateForm(beginningNode);if(pageHasErrors!="0"){document.getElementById("dynamicERRBoxContent").innerHTML="We're sorry; some of the information below is missing or was filled out incorrectly.";document.getElementById("dynamicERRBox").style.display="";return 0;}else{document.getElementById("dynamicERRBox").style.display="none";return 1;}}
function validateForm(node){if(node.nodeName!="#comment"){if(node.nodeType!=3&&node.getAttribute('hh_validate_me')!=null&&node.getAttribute('hh_validate_me')!="0"){currentNodeBeingValidated=node;errorCheckResult=eval(node.getAttribute('hh_validate_function')+"("+")");if(errorCheckResult){try{document.getElementById(node.getAttribute('hh_validate_label')).className="formErrorLabel";}catch(e){};try{document.getElementById(node.getAttribute('hh_validate_msg')).style.display="";}catch(e){};pageHasErrors="1";}else{try{document.getElementById(node.getAttribute('hh_validate_label')).className="";}catch(e){};try{document.getElementById(node.getAttribute('hh_validate_msg')).style.display="none";}catch(e){};}}
if(node.childNodes!=null){for(var x=0;x<node.childNodes.length;x++){validateForm(node.childNodes.item(x));}}}}
function phone_notrequired(){if(TrimString(currentNodeBeingValidated.value)==""||TrimString(currentNodeBeingValidated.value)=="--"){return false;}else{pattern=new RegExp('^[0-9]{3}-[0-9]{3}-[0-9]{4}$','g');if(pattern.test(TrimString(currentNodeBeingValidated.value))==false){return true;}else{return false;}}}
function url_notrequired(){if(TrimString(currentNodeBeingValidated.value)==""){return false;}else{var isPrepend_HTTP=false;var strurl=currentNodeBeingValidated.value;if(strurl.indexOf('http://')==0||strurl.indexOf('https://')==0||strurl.indexOf('ftp://')==0)
{isPrepend_HTTP=false;}else{isPrepend_HTTP=true;strurl='http://'+strurl;}
pattern=new RegExp('^(((http(s?))|(ftp))\\:\\/\\/)?((([a-zA-Z0-9:_]+@)?([a-zA-Z0-9\-]+[a-zA-Z0-9\-]*)\\.([a-zA-Z0-9\-]+[a-zA-Z0-9\-]*\\.)*(com|[a-zA-Z]+))|([0-9]{1,3}(\\.[0-9]{1,3}){3}))(:[0-9]{1,5})?((\\/|\\?).*)*$','g');if(pattern.test(TrimString(strurl))==false){return true;}else{if(isPrepend_HTTP){currentNodeBeingValidated.value=strurl;}
return false;}}}
function validateSubjectLine()
{if(currentNodeBeingValidated.value==""){return false;}else{var arr=currentNodeBeingValidated.value.split(" ");arr.sort();for(var i=0;i<arr.length-1;i++)
{if(arr[i]==arr[i+1])
return true;}
return false;}}
function atLeastOneCheckRequired(checkBox)
{if(typeof checkBox.length=="undefined")
{if(checkBox.checked==true)
{return false;}
else
{return true;}}
for(i=0;i<checkBox.length;i++)
{if(checkBox[i].checked==true)
{return false;}}
return true;}