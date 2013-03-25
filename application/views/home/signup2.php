<div class="signupStepBody standardFont">

<h1>Fill out your profile info</h1>

<form name="loginForm" method="POST" action=<?php echo "".$base."/index.php/home/signupStep2"?>>
            <input type="hidden" name="id" value="<?php echo $id ?>"/>
            <div>
            <a>High School:</a>
            </div>
            <input id="signup23-15-11" type="text"  alt="" name="school"/>
            <div>
            <a>College/University:</a></div>
    
            <input id="signup23-15-18" type="text" alt="" name="college">
            <div id="employer">
                <a>Employer:</a>
            </div>
            <input id="signup23-15-25" type="text"  alt="" name="employer">

            <div id="submitdiv">
                <input type="submit" value="Save & Continue"/>
            <!--//		<img src="images/signup23_15_33.gif" width="106" height="25" alt="">-->
            </div>
        </form>
        
<a href=<?php echo $base."/index.php/home/gotoPage/signup3"?>>Skip this step </a>
</div>