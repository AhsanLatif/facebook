<div class="well fTop fullHeight justify resetPass">

<h1>Change Your Password</h1>
<hr>
<form name="PasswordChange" method="post" onsubmit="return validatePassChange();"action=<?php echo "".$base."/index.php/process/changePassword"?> >


<label>Password:<input type="password" name="newPassword"  id="newPassword"  required="required"/></label><br>
<label>Confirm:<input type="password" name="newPasswordCon" id="newPasswordCon " required="required"/></label>
<input type="hidden" name="Email" value=<?php echo $msg; ?> />

</div>
<div class=" well fTop fullHeight justify mainBlueColor resetPassBottom">
<!--<a href="#" class="pull-left">I can't identify my account </a>-->

<input class="btn-submit pull-Right"type="submit" value="Enter"/>


<div class="alert-error" id="wrongPass">
</div>

</div>

</form>
