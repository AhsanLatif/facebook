//Jquery Calls
$(document).ready(function() {
  
  
  $('body').css('width',$(window).width());
  $('body').css('width',document.body.offsetWidth);

//Date Picker- Date of Birth in Sign Up form
  $("#datepicker").datepicker( {
    viewMode: "years",
});

  
  //Profile Picture Upload
 $('#file').bind('change', function() {
	
  var MB=Math.ceil(this.files[0].size/ 1048576);
  var picURL=$('#file').val();
   $('p#invalidation').html("");
var ext = picURL.split('.').pop().toLowerCase();
if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
     $('p#invalidation').html("Invalid file type: Select an image");
	$('#profilePicChooser')[0].reset();
}
else if(MB>4)
{
 $('p#invalidation').html("File size should be less than 4MB");
	$('#profilePicChooser')[0].reset();
}

});

//Check for cookies
$('input[name=loginEmail]').val(getCookie("username"));
$('input[name=loginPassword]').val(getCookie("password"));
//Login Form Handling
$('#loginForm').on('submit',function()
	{
		if($('#rememberMe').is(':checked'))
		{
		alert($('#loginEmail').val());
			setCookie("username",$('#loginEmail').val(),350);
			setCookie("password",$('#loginPassword').val(),350);
		}
	}
	
	);
	
//profile pic-thumbnail resizing
var src = $('.proPicToBeResized[alt="propic"]').attr('src');
var image=new Image();
image.src=src;
$('<div><img src='+src+' style="position:relative; display:inline;" /><div>')
        .css({
            float: 'right',
            position: 'relative',
            overflow: 'hidden',
            width: '100px',
            height: '100px',
			bottom:'70px',
			left:'40px'
        })
        .insertAfter($('#propic'));

$('#propic').imgAreaSelect({ aspectRatio: "1:1", onSelectChange: preview });  

function preview(img, selection) {
	  var scaleX = 100 / (selection.width || 1);
    var scaleY = 100 / (selection.height || 1);
  
    $('#propic + div > img').css({
        width: Math.round(scaleX * image.width) + 'px',
        height: Math.round(scaleY * image.height) + 'px',
        marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
        marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
    });
}
 
 
 
//profile stuff
$('.profileInfoTextWrapper').mouseover(
function()
{
$('.profileInfoTextWrapper').css('text-decoration','underline');
}


).mouseout(

function()
{
$('.profileInfoTextWrapper').css('text-decoration','none');

}

); 

$('#pro').mouseover(
function()
{

$('#pictureChanger').css('display','block');
$('#pictureChanger').css('z-index','2');
}


).mouseout(

function()
{
$('#pictureChanger').css('display','none');
$('#pictureChanger').css('z-index','1');

}

);

 $('#profileInfoTextWrapper').tooltip({
    title: 'Click to edit!',
	placement: 'bottom'
  });
 //Wall functionality

$('#buttonPost').click(function()
{
var wall=$('#post').val();
alert(wall);
var path=$('#path').val();
var id=$('#id').val();
var to=$('#fid').val();
alert('here');
$.ajax({
type:'post',
url:path,
data:{'id':id,'fid':to,'post':wall},
success:function(result)
{
var obj = jQuery.parseJSON(result);
var newPost="<div class='postWall'> <p>"+obj.first_name+" "+obj.last_name+": "+wall+"</p></div>";
$(newPost).insertAfter('.helper');
}
});

});


 
});


//Reference: w3schools.com

var msg;
function setCookie(c_name,value,exdays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
document.cookie=c_name + "=" + c_value;
}
function getCookie(c_name)
{
var i,x,y,ARRcookies=document.cookie.split(";");
for (i=0;i<ARRcookies.length;i++)
{
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x==c_name)
    {
    return unescape(y);
    }
}
	
}

function validate_password(password)
{
	if(password.length > 30)
	{
		alert("Password too big");
		return false;
	}
	
	if (password=="")
	{
		msg="Please enter your Password";
		return false;
	}
	
	if(password.length <=4)
	{
		msg="Password too small";
		return false;
	}
	
	return true;
	
}

function validate_name(name)
{

	if(!/^[a-zA-Z\_]+$/g.test(name))
	{
		return false;
	}
	
	return true;
}

function isEqual(A,B)
{
return (A==B);
}

function validatePhone(num)
{
var phone_exp = /^\(?([0-9]{4})\)?[-. ]?([0-9]{7})$/;
	
	return phone_exp.test(num);
}

function validatePassChange()
{
var pass=document.forms["PasswordChange"]["newPassword"].value;
var passCon=document.forms["PasswordChange"]["newPasswordCon"].value;
if(!isEqual(pass,passCon) || !validate_password(pass))
{
document.getElementById("wrongPass").innerHTML="Passwords Not Valid";
return false;
}

return true;
}
function validateSignup()
{

var milliPerYear=1000*60*60*24*365.26;
var selectYear=document.forms["signupForm"]["datepicker"].value;
var firstname=document.forms["signupForm"]["Fname"].value;
var lastname=document.forms["signupForm"]["Lname"].value;
var pass=document.forms["signupForm"]["password"].value;
var Email=document.forms["signupForm"]["Email"].value;
var ConEmail=document.forms["signupForm"]["EmailCon"].value;
var Phone=document.forms["signupForm"]["Phone"].value;
if(!validate_name(firstname) || !validate_name(lastname))
{
document.getElementById("invalidation").innerHTML="Invalid name";
msg="";
return false;
}

else if(!validate_password(pass))
{
document.getElementById("invalidation").innerHTML="Password is too short";
return false;
}
else if(!isEqual(Email,ConEmail))
{
document.getElementById("invalidation").innerHTML="Emails do not match";
return false;
}
else if (!validatePhone(Phone))
{
document.getElementById("invalidation").innerHTML="Phone number is incorrect";
return false;
}


var selectDate=new Date(selectYear);
var today=new Date();
var years=(today-selectDate)/milliPerYear;
if(years<13)
{
document.getElementById("invalidation").innerHTML="You are under age";
return false;
}

return true;

}
