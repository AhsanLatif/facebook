//Jquery Calls
$(document).ready(function() {
    var basePath="http://localhost/webProject/index.php/";


    var sitePath="http://localhost/webProject/";
    $( ".link" ).on( "click", function(e) {
        e.preventDefault();
        var link = $(".link" ).attr('href');
        //  alert(link);
        $(".link12").remove();
        $.ajax({
            url: link,
            type: 'get',
            success: function( data ) {
                $( ".link" ).html( "<strong>"+ data + "</strong>" );
            }
        });
    });
    
    $( ".link12" ).on( "click", function(e) {
        e.preventDefault();
        var link = $( ".link12" ).attr('href');
        //        alert(link);
        $(".link").remove();
        
        $.ajax({
            url: link,
            type: 'get',
            success: function( data ) {
                $( ".link12" ).html( "<strong>"+ data + "</strong>" );   
            }
        });
    });
    
    $('body').css('width',$(window).width());
    $('body').css('width',document.body.offsetWidth);

    //Date Picker- Date of Birth in Sign Up form
    $("#datepicker").datepicker( {
        viewMode: "years"
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
	var user=$.cookie("username");
	
	
	var password=$.cookie("password");
	if(user!=false && password!=false)
	{
    $('input[name=loginEmail]').val(user);
    $('input[name=loginPassword]').val(password);}
    //Login Form Handling
    $('#loginForm').on('submit',function()
    {
        if($('#rememberMe').is(':checked'))
        {
	
		  $.cookie("username", null);
		   $.cookie("password", null);
            $.cookie("username", $("#loginEmail").val(), { expires: 7 });
            $.cookie("password", $("#loginPassword").val(), { expires: 7 });
        }
    }
	
    );
	
    //profile pic-thumbnail resizing
    var src = $('.proPicToBeResized[alt="propic"]').attr('src');
    var image=new Image();
    image.src=src;
    $('<div><img src='+src+' style="position:relative; display:inline;" /><div>')
    .css({
        'float': 'right',
        'position': 'relative',
        'overflow': 'hidden',
        'width': '100px',
        'height': '100px',
        'bottom':'70px',
        'left':'40px'
    })
    .insertAfter($('#propic'));

    $('#propic').imgAreaSelect({
        aspectRatio: "1:1", 
        onSelectChange: preview
    });  

    function preview(img, selection) {
        var scaleX = 100 / (selection.width || 1);
        var scaleY = 100 / (selection.height || 1);
  
        $('#propic + div > img').css({
            width: Math.round(scaleX * img.width) + 'px',
            height: Math.round(scaleY * img.height) + 'px',
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
        var path=$('#path').val()+"/addWallPost";
        var id=$('#id').val();
        var to=$('#myID').val();
        $.ajax({
            type:'post',
            url:path,
            data:{
                'id':id,
                'myID':to,
                'post':wall
            },
            success:function(result)
            {
                var obj = jQuery.parseJSON(result);
                var newPost="<div class='postWall'> <p>"+obj.first_name+" "+obj.last_name+": "+wall+"</p></div>";
                $(newPost).insertAfter('.helper');
            }
        });

    });
    $('a').css('cursor','pointer');

    //Notification stuff


    $(function()
    {
        var id=$('#currid').val();
       
        var path=basePath+"profile/getNotification";
        $.ajax({
            type:'post',
            url:path,
            data:{
                'id':id
            },
            success:function(data)
            {
                if(data!="nada")
                {
                    var obj=jQuery.parseJSON(data);
                    var html="";
                    for(var i =0;i <obj.length-1;i++)
                    {

                        html=html+"<li><a href="+basePath+"/profile/removeNotification/"+obj[i].id+">"+obj[i].notice+"</a></li>";
 
                    }
                    $('#noList').html(html);
                    if(i>0)
                    {
                        $('#notifications button').css('background-color','red');
                    }

                }
            }
        });
    });

    setInterval(function() {
        var id=$('#currid').val();
       
        var path=basePath+"/profile/getNotification";
        $.ajax({
            type:'post',
            url:path,
            data:{
                'id':id
            },
            success:function(data)
            {
                if(data!="nada")
                {
                    var obj=jQuery.parseJSON(data);
                    var html="";
                    for(var i =0;i <obj.length-1;i++)
                    {
                        html=html+"<li><a href="+base+"/removeNotification/"+obj[i].id+">"+obj[i].notice+"</a></li>";
                    }
                    $('#noList').html(html);
                    if(i>0)
                    {
                        $('#notifications button').css('background-color','red');
                    }

                }

            }
        });
    }, 5000);
 
 
    $('#searchFriends').on('click', function()
 
    {


            var query=$('#searchFrend').val();

            var path=$('#path').val()+"/SearchFriends";

            $.ajax({
                type:'post',
                url:path,
                data:{
                    'query':query
                },
                success:function(data)
                {
                    alert(data);
                    if(data!="nada")
                    {
                        var obj=jQuery.parseJSON(data);
                        var Vhtml="";
					
                        for(var i =0;i <obj.length-1;i++)
                        {
                            Vhtml=Vhtml+"<div class='GalleryImage fTop'>"+"<a href='"+basePath+"profile/viewProfile?id="+ obj[i].friend_id+"'>"+
                            "<img src='"+sitePath+"uploads/"+obj[i].image_name+"' alt='myImage!' width='110' height='90' /></a><div class='GalleryCaption'>"+obj[i].friend_first_name+"</div></div>";
					
                     
                        }
                        $('#randomDiv').html(Vhtml);

                    }

                }
            });
 
        }
 
        );
   


    $('#searchMutualFriends').on('click', function()
 
    {

 
            var query=$('#searchMFrend').val();
            var path=basePath+"/profile/SearchMutualFriends";
            var fID=$('#myID').val();
 
            $.ajax({
                type:'post',
                url:path,
                data:{
                    'query':query, 
                    'frndID':fID
                },
                success:function(data)
                {
		
                    if(data!="nada")
                    {
                        var obj=jQuery.parseJSON(data);
                        var html="";
					
                        for(var i =0;i <obj.length;i++)
                        {
                            html=html+"<div class='GalleryImage fTop'>"+"<a href='"+basePath+"profile/viewProfile?id="+ obj[i].friend_id+"'>"+
                            "<img src='"+sitePath+"uploads/"+obj[i].image_name+"' alt='myImage!' width='110' height='90' /></a><div class='GalleryCaption'>"+obj[i].friend_first_name+"</div></div>";
					
                     
                        }
                        $('#randomDivM').html(html);

                    }

                }
            });
		
		
 
        }
 
        );
   
    //File Drag and Drop
    Dropzone.options.dropFiles = {
        paramName: "userfile", // The name that will be used to transfer the file
        maxFilesize: 4,
        dictDefaultMessage: 'Drop A Picture Here! or Click to Upload',  
        accept: function(file, done) {
            var ext = file.name.split('.').pop().toLowerCase();
            if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
            {
                done("wrong file format");
            }
            else
            {
                done();
            }
        },
        complete: function(file, done) {
    
            //this.removeFile(file);
	
            $('#PicText').attr("placeholder", "Enter a caption before you drop");

	
        }
	
    
	
    }
    ;
	Dropzone.options.dropVFiles = {
        paramName: "video", // The name that will be used to transfer the file
        maxFilesize: 10,
        dictDefaultMessage: 'Drop A Video Here! or Click to Upload',  
        accept: function(file, done) {
            var ext = file.name.split('.').pop().toLowerCase();
            if($.inArray(ext, ['mp4','3gp','avi','flv', 'wmv']) == -1)
            {
                done("wrong file format");
            }
            else
            {
                done();
            }
        },
        complete: function(file, done) {
    
            //this.removeFile(file);
	
            $('#VidText').attr("placeholder", "Enter a caption before you drop");

	
        }
	
    
	
    }
    ;
	
    $('#doneDragging').on('click',function(){

        $('#doneDragging').text('Some Remove Text');
        $('#dropFiles').html("<label>Caption </label><input type='text' name='PicText' />");
    });
$('#doneVDragging').on('click',function(){

        $('#doneDragging').text('Some Remove Text');
        $('#dropVFiles').html("<label>Caption </label><input type='text' name='VidText' />");
    });


    
 
    //long polling for newsfeed
    var idFrom=0;
    (function poll(){

        idFrom=$('#currId').val();

        var path=basePath+"newsfeed/getPosts/"+idFrom;

        $.ajax({
            url: path,  
            success: function(data){
			
                var obj=jQuery.parseJSON(data);
                var ran=0;
                var html="";
			
{
$(document).ready(function(){
   $("a[rel^='prettyPhoto']").prettyPhoto({theme: "facebook",slideshow:5000, autoplay_slideshow:false});
});
}						
                for(var i =0;i <obj.length;i++)
                {
					
				var closebutt='<img class="deleter" src="'+sitePath+'/media/images/close_button.png" style="width:10px; height:10px; cursor:pointer" onclick="jQuery.deletePost('+obj[i].post_id+')";>';
					var me=$('#session').val();
					if(obj[i].user_id !=me)
					{
					closebutt=" ";
					}
  
                    if(obj[i].type=='1')
                    {
					var pretty="<a rel='prettyPhoto' href='"+sitePath+'uploads/'+obj[i].link+"' >";
					var content=escapeHTML(obj[i].content);
						html='<div id='+obj[i].post_id+'><div class="post-container">  '+'<h3 class="post-title">'+obj[i].first_name+' Posted:'+closebutt+'</h3>' +'<div class="post-thumb"><a rel="prettyPhoto" href="'+sitePath+'uploads/'+obj[i].link+'" ><img src="'+sitePath+'uploads/'+obj[i].link+'" /></a></div>'+ '<div class="post-content">'+'<p>'+content+'</p>'+'</div></div></div><hr><br>';
						$('#currId').val(obj[i].post_id);
                        $(html).insertAfter('#newPostAdder');	
                    }
                     else if(obj[i].type=='4')
                    {
					var content=escapeHTML(obj[i].content);
			html='<div id='+obj[i].post_id+'><div class="post-container">  '+'<h3 class="post-title">'+obj[i].first_name+' Posted:'+closebutt+'</h3><br>' + '<div class="post-content">'+'<p>'+content+'</p>'+'</div><object width="338" height="300"> <param name="src" value="'+sitePath+'video/'+obj[i].link+'"> <param name="autoplay" value="false"><param name="controller" value="true"><param name="bgcolor" value="#333333"><embed TYPE="application/x-mlayer2" src="http://localhost/webProject/video/'+obj[i].link+'" autostart="false" loop="false" width="338" height="300" controller="true" bgcolor="#333333"></embed></object>'+'</div></div><hr><br>';
					
					                    //     html = '<div id="'+obj[i].post_id+'"> <u>'+obj[i].first_name+' posted</u>:'+closebutt+' <br><br><p> <video width="320" height="240" controls><source src="http://localhost/webProject/video/'+obj[i].link+'" type="video/avi"></source></video><div style="text-align:center" class="GalleryCaption">'+obj[i].content+'</div></p><hr><br><br> </div>';				 

					$('#currId').val(obj[i].post_id);
                        $(html).insertAfter('#newPostAdder');	
                    }else if(obj[i].type=='2')
                    {
					
						html='<div id='+obj[i].post_id+'><div class="post-container">  '+'<h3 class="post-title">'+obj[i].first_name+' Posted:'+closebutt+'</h3>' +'<div class="post-thumb"><a href="'+obj[i].link+'" ><img src="'+obj[i].linkimage+'" /></a></div>'+ '<div class="post-content">'+'<p>'+escapeHTML(obj[i].content)+'</p>'+'</div></div></div><hr><br>';
						$('#currId').val(obj[i].post_id);
                        $(html).insertAfter('#newPostAdder')	;
                    }
					else
					{
					 	html='<div id='+obj[i].post_id+'><div class="post-container">  '+'<h3 class="post-title">'+obj[i].first_name+' Posted:'+closebutt+'</h3>'+'<div class="post-content-normal"><p>'+escapeHTML(obj[i].content)+'</p>'+'</div></div></div><hr><br>';

						$('#currId').val(obj[i].post_id);
                        $(html).insertAfter('#newPostAdder')	;
					}
	
                    ran++;
                         
                }
	
			
                {
                    
                }
            } , 
            complete: poll, 
            timeout: 10000000
        });
    })();

    
 
 
    $('#simplePost').on('click',function()
    {
	$('#linkloading').css('display','inline');
        var content=$('#statusPost').val();
        var path=basePath+"newsfeed/postEvaluate";
        if(content!="")
        {
            $.ajax({
                url: path, 
                data:{
                    'content':content
                },
                type:"post"	,
success: function(data)
{
$('#linkloading').css('display','none');
}				
			
            });
        }
		
    }); 
 


jQuery.extend( {
    deletePost: function(id) { 
      var myID=id;
	  var path=basePath+"newsfeed/delete_post";
	  var answer = confirm ("Are you sure you want to delete this item?");
	  if(answer)
	  {
	  $.ajax(
	  {
		url:path,
		data:{
		'postid':id
		},
		type:'post',
		success:function(data)
		{
		var alerter="<div width='300px' class='alert alert-block  fade in'>"+"<button type='button' class='close' data-dismiss='alert'>&times;</button>"+ "<h4 class='alert-heading'>Your post has been deleted!</h4><p>Press close button to dismiss</p></div>";
		  $(alerter).insertAfter('#'+id);
			$('#'+id).remove();
		}
	  }
	  );
    }
}});

var escapeHTML = (function () {
    'use strict';
    var chr = {
        '"': '&quot;', '&': '&amp;', "'": '&#39;',
        '/': '&#47;',  '<': '&lt;',  '>': '&gt;'
    };
    return function (text) {
        return text.replace(/[\"&'\/<>]/g, function (a) { return chr[a]; });
    };
}());

$('#coverPhoto').mouseover(function()
{
$('#coverChanger').css('display','block');
}

).mouseout(
function()
{
$('#coverChanger').css('display','none');
}

);

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
	return false;
	
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
