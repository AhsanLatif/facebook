<div class="well fTop fullHeight justify resetPass">

<h1>Identify Your Account</h1>
<hr>
<form name="Identify" method="post" action=<?php echo "".$base."/index.php/process/sendResetCode"?> >
<div class="fLeft"><img src=<?php echo "" . $base . "/" . $uploads . "/" . $pic . ""; ?> class="thumbnail tinyThumbnail" /><?php echo $name ?></div>
<div class="pull-left fTop">Is this your account?<br> 
<label><input type="radio" name="accountIdentify"  id="accountIdentify"value="Yes" required="required"/>Yes</label>
<label><input type="radio" name="accountIdentify" id="accountIdentify"value="No" required="required"/>No</label></div>

</div>
<div class=" well fTop fullHeight justify mainBlueColor resetPassBottom">
<!--<a href="#" class="pull-left">I can't identify my account </a>-->

<input class="btn-submit pull-Right"type="submit" value="Enter"/>


<div class="alert-error">
<?php 
if(isset($error))
{
echo $error;
unset($error);
}

?>
</div>

</div>

</form>
