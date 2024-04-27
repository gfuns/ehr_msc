// JavaScript Document
function validate(obj)
{
	if(validateRequired(obj.paper,"Paper Title is required.")==false)
	return false;
	if(validateRequired(obj.author,"Author name is required.")==false)
	return false;
	if(validateRequired(obj.email,"Email Address is required.")==false)
	return false;
	
	if(!validateEmail(obj.email.value))
	{
		alert("Email address should be in proper format.");
		obj.email.focus();
		return false;
	}
	
	if(validateRequired(obj.abstracts,"Please specify research abstracts.")==false)
	return false;
	if(validateRequired(obj.area,"Please select research area.")==false)
	return false;
	
//	if(validateRequired(obj.keywords,"Please specify keywords.")==false)
//	return false;
	if(validateRequired(obj.country,"Author country is required.")==false)
	return false;
	
	
	if(validateRequired(obj.manuscript,"Please upload manuscript/research file.")==false)
	return false;
	
//	if(validateRequired(obj.reference,"Please specify references.")==false)
//	return false;
	
	document.getElementById("btnSubmit").style.display = "none";
	document.getElementById("proc_text").innerHTML = "Uploading in progress... please wait for a while...";	
	return true;
}

function validateRequired(ctrl,message)
{
	if(ctrl.value=="")
	{
		alert(message);
		ctrl.focus();
		return false;
	}
	return true;
}
function DoHear(obj)
{
	if(obj.value=="Other")
	{
		document.getElementById("spspec").style.visibility="visible";
	}
	else
	{
		document.getElementById("spspec").style.visibility="hidden";
	}
}

function validateEmail(elementValue){
   var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
   return emailPattern.test(elementValue);
 }
function ValidateRef(obj)
{
	if(validateRequired(obj.ref_num,"Reference Number is required.")==false)
	return false;
}

function validate_contact(obj)
{
	if(validateRequired(obj.name,"Please enter your name.")==false)
	return false;
	if(validateRequired(obj.email,"Email Address is required.")==false)
	return false;
	
	if(!validateEmail(obj.email.value))
	{
		alert("Email address should be in proper format.");
		obj.email.focus();
		return false;
	}
	
	if(validateRequired(obj.message,"Please enter your query.")==false)
	return false;
}


function validate_paper(obj)
{
	if(validateRequired(obj.paper_id,"Paper ID is required!!")==false)
	return false;
}