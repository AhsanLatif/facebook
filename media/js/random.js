'<div id='+obj[i].post_id+'><div class="post-container">  '              
    +'<div class="post-thumb"><a rel="prettyPhoto" href="'+sitePath+'uploads/'+obj[i].link+'" ><img src="'+sitePath+'uploads/'+obj[i].link+'" /></a></div>'
   + '<div class="post-content">'
        '<h3 class="post-title">'+obj[i].first_name+' Posted:'+closebutt'</h3>'
+'<p>'+obj[i].content+'</p>'+
		'</div></div></div><br><hr>'
		
html='<div id='+obj[i].post_id+'><div class="post-container">  '+'<h3 class="post-title">'+obj[i].first_name+' Posted:'+closebutt+'</h3>' +'<object width="338" height="300"> <param name="src" value="'+sitePath+'video/'+obj[i].link+'"> <param name="autoplay" value="false"><param name="controller" value="true"><param name="bgcolor" value="#333333"><embed TYPE="application/x-mlayer2" src="http://localhost/webProject/video/'+obj[i].link+'" autostart="false" loop="false" width="338" height="300" controller="true" bgcolor="#333333"></embed></object>'+ '<div class="post-content">'+'<p>'+content+'</p>'+'</div></div></div><hr><br>';

		
html = '<div id="'+obj[i].post_id+'"> <u>'+obj[i].first_name+' posted</u>:'+closebutt+' <br><br><p><object width="338" height="300"> <param name="src" value="'+sitePath+'video/'+obj[i].link+'"> <param name="autoplay" value="false"><param name="controller" value="true"><param name="bgcolor" value="#333333"><embed TYPE="application/x-mlayer2" src="http://localhost/webProject/video/'+obj[i].link+'" autostart="false" loop="false" width="338" height="300" controller="true" bgcolor="#333333"></embed></object><div style="text-align:center" class="GalleryCaption">'+escapeHTML(obj[i].content)+'</div></p><hr><br><br> </div>';				 
