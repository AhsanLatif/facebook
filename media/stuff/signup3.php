<script type="text/javascript">

$(document).ready(function() {
$('#profilePic').bind('change', function() {
	
  var MB=Math.ceil(this.files[0].size/ 1048576);
  var picURL=$('#profilePic').val();
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


});
</script>

<div class="signupStepBody standardFont">

<h1>Upload a Picture!</h1>
<form id="profilePicChooser" name="profilePicChooser" onsubmit="return validatePicUpload();" action="http://google.com">
<input type="file" value="Browse Images" id="profilePic" name="profilePic" placeholder="browse"/>
<span class="placeAtBottom"><input type="submit" id="submitButtonlogin" value="save"></span>
<div id="viewPic" style="width:500px; height:auto">
</div>
<p id="invalidation"> </p>
</form>
<div id="picturePreview">
<img src=<? echo "".$base."/".$images."/defaultPic.gif" ;?> />
</div>
<span class="placeAtBottom"><a href=<?php echo $base."/index.php/home/gotoPage/signup3"?>>Skip this step </a></span>

</div>