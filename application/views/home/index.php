<!--http://www.webmotionuk.co.uk/php-jquery-image-upload-and-crop/-->


<div id="mainBodyHomepage">

<div id="newsHeading">
<h1>Introducing Graph Search</h1>
Find more of what you're looking for through your friends<br> and connections
<a href="#" > Learn More </a>

</p>
<img  src=<?php echo "".$base."/".$images."/login/newsVid.jpg" .""; ?> />

</div>


<div id="signupForm">

<form name="signupForm"class="form" method="POST" onsubmit="return validateSignup();" action=<?php echo "".$base."/index.php/home/signUp"?>>
<h1> Sign Up</h1>
<h3 class="grayHeading"> It's free and always will be. </h3>
<input type="text" name="Fname" class="Input192px" placeholder="First Name"  required="required"/>
<input type="text" name="Lname"class="Input192px" placeholder="Last Name"  required="required" /><br/>
<input type="text" class="Input398px" name="Email"  pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$" placeholder="Your Email" required="required"/><br/>

<input type="text" class="Input398px" name="EmailCon"  pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$" placeholder="Confirm Email" required="required"/><br/>

<input type="text" class="Input398px" placeholder="Enter Phone" name="Phone"/><br/>
<input type="password" class="Input398px"  placeholder="New Password" required="required" name="password"/><br/>
<label class="grayHeading">Birthday:</label><br/>
<input id="datepicker" name="Bdate" enabled="false" />
<br/>
<label><input type="radio" name="Gender" value="Female" required="required"/>Female</label>
<label><input type="radio" name="Gender" value="Male" required="required"/><label name="Gender">Male</label>
<p class="grayHeading"> By clicking Sign Up you agree to our <a href=<?php echo "". $base."/index.php/policies/index/terms"?>> Terms </a> and that you have read our <a href =<?php echo "". $base."/index.php/policies/index/terms"?>>Data Use Policy</a> including our <a href=<?php echo "". $base."/index.php/policies/index/cookies"?>> Cookie Use </a></p>
<input id="signupButton" type="submit" value="Sign Up"/>
<span class="alert alert-error" id="invalidation">
<?php 
if(isset($msg)){
    echo $msg; 
}
?></span>
</form>

<hr id="signupLineBreak"/>


</div>
</div>
</body>