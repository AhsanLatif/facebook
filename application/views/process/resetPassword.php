<div class="well fTop fullHeight justify resetPass">

<h3>Reset Password</h3>

<hr>
<form name="resetPass" method="post" action=<?php echo "".$base."/index.php/process/findAccount"?> >
<label>Enter Email to find your account: </label>
<br>
<img src=<?php echo "".$base."/".$images."/helperPages/mailIcon.jpg" ;?> />
<input class="input-large" type="email" required="required" name="resetEmail" id="resetEmail"/>


</div>
<div class=" well fTop fullHeight justify mainBlueColor resetPassBottom">
<!--<a href="#" class="pull-left">I can't identify my account </a>-->
<a class="btn pull-Right" href=<?php echo "".$base."/index.php/home"; ?>>Cancel </a>
<input class="btn pull-Right"type="submit" value="search"/>


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
