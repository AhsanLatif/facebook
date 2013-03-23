

<div class="signupStepBody standardFont">

<h1>Upload a Picture!</h1>
<form enctype="multipart/form-data"  id="profilePicChooser" name="profilePicChooser" method="post" onsubmit="return validatePicUpload();" action=<?php echo "".$base."/index.php/home/profilePhotoUpload"?>>
<input type="file" name="userfile" id="file"><br>
  <input type="hidden" name="id" value= <?php echo $id ?> />
<input class="btn-submit" type="submit" id="submitButtonlogin" value="save">
<p id="invalidation"> </p>
</form>

<a class="pull-left btn" href=<?php echo $base."/index.php/process"?>>Skip this step </a>

</div>