
<?php  

if($school=="")
$school="n/a";
if($university=="")
$university="n/a";
if($employer=="")
$employer="n/a";



 ?>
<input type="text" data-provide="typeahead" id="tA" data-source=<?php echo json_encode($arr) ?> />

<div id="coverPhoto" class="coverPhoto">

<img src=<?php echo "".$base."/".$images."/defaultCover.jpg" ?> />
</div>
<div class="profileWrapper fTop mainBlueColor">



<div id="infoEditor" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Edit your info</h3>
  </div>
  <div class="modal-body">
    <div>
	
<form name="infoEdit" id="infoEdit">
<label> School 
<input name="School" type="text" value=<?php echo "".$school."" ?> /></label>
<label> University
<input name="University" type="text"    value=<?php echo "".$university."" ?>  /> </label>
<label> Employer
<input name="Employer" type="text"   value=<?php echo "".$employer."" ?>  /> </label>
<label> Birthday 
<input id="datepicker" type="text" value=<?php echo "".$bday."" ?> name="Bdate"    enabled="false"/></label>
</form>

</div>
	
  </div>
  <div class="modal-footer">
    <a href="#" class="btn">Close</a>
    <a href="#" class="btn btn-primary">Save changes</a>
  </div>
</div>
<!--- -->




<div id="pictureChange" class="modal hide fade in" style="display: none; ">
<div class="modal-header">
<a class="close" data-dismiss="modal">×</a>
<h3>Profile Pic Panel</h3>
</div>
<div class="modal-body">

<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Edit Thumbnail</a></li>
    <li><a href="#tab2" data-toggle="tab">Remove Picture</a></li>
	<li><a href="#tab3" data-toggle="tab">Change Picture</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
      <p>
<span class="fLeft"><img class="proPicToBeResized" alt="propic" id="propic"src=<?php echo "" . $base . "/" . $uploads . "/" . $image_path . ""; ?> /></span>
<p>drag your mouse on the image to select thumbnail area</p>	


<form name="thumbnail"  method="post" action=<?php echo "" . $base . "/index.php/profile/cropPicture"?>>
				<input type="hidden" name="x1" value="" id="x1" />
				<input type="hidden" name="y1" value="" id="y1" />
				<input type="hidden" name="x2" value="" id="x2" />
				<input type="hidden" name="y2" value="" id="y2" />
				<input type="hidden" name="w" value="" id="w" />
				<input type="hidden" name="h" value="" id="h" />
				<input type="submit" class="btn-success" />
			        
</form>
</p>
    </div>
   
   <div class="tab-pane" id="tab2">
      <p><a href=<?php echo "".$base."/index.php/profile/removePic" ?>>Click to remove picture</a></p>
    </div>
	  <div class="tab-pane" id="tab3">
      <p>
	  
	  
	  <form enctype="multipart/form-data"  id="profilePicChooser" name="profilePicChooser" method="post" onsubmit="return validatePicUpload();" action=<?php echo "".$base."/index.php/profile/profilePhotoUpload"?>>
<input type="file" name="userfile" id="file"><br>
  <input type="hidden" name="id" value= <?php echo $id ?> />

<input class="btn-success" type="submit"  value="save">

<p id="invalidation"> </p>
</form>
	  </p>
    </div>
  
</div>

</div>
<div class="modal-footer">


<a href="#" class="btn" data-dismiss="modal">Ok</a>
</div>
</div>
</div>

<!--Start of page -->



<div class="personDetailProfile fTop">
<div id="pro">
<div id="pictureControl"><a  data-toggle="modal" href="#pictureChange" class="btn btn-primary">Edit Profile Picture</a></div>
<img class="thumbnail fLeft" id="propic" src=<?php echo "" . $base . "/" . $uploads . "/" . $image_path . ""; ?> /></div>


<span class="profileInfo well pull-left"><?php echo "<a  data-toggle='modal' href='#infoEditor'><span  id='profileInfoTextWrapper'class='profileInfoTextWrapper well pull-left'><p class='profileInfoText'><h3>".$name."</h3>Birthday:".$bday."<br> School:".$school."<br>University:".$university."<br>Employer:".$employer."</p></span></a>" ?>

<div class="profileOptions fRight">
<img class="fLeft" src=<?php echo "" . $base . "/" . $images . "/friends-icon.jpg"; ?> />

</div>
</span><br>


</div>


<div class="wall fTop">
<h1> Post Something! </h1>
<hr>
<form id="Wall" name="wall">
<input type="text" id="wallPost" name="wallPost"/></br>
<input type="submit" class="btn" value="Post" />
</form>
</div>



</div>


<div class="clearfix"></div>
<hr>
