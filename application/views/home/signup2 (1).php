
<div class="signupStepBody standardFont">
    <div id="stepbar">
        <img src="images/upper-mid_03.gif" width="627" height="53" alt="">
    </div>
    <div id="table-mid">
        <div id="signup23-15-03">
            <a>Fill out your profile info</a>
        </div>
        <div id="signup23-15-05">
            <a>This information will help you find your friends on facebook</a>
        </div>
        <div id="hotmailtext">
            
        </div>
        <form name="loginForm" method="POST" action="http://localhost/facebook/index.php/home/signupStep2">
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
        
    </div>
    <div id="lower-box">
        <div id="bulb">
            <img src="images/signup1_09_03.gif" width="23" height="29" alt="">
        </div>
        <div id="writing">
            Your schools and employer are currently public to help you connect with classmates and coworkers. You can manage the visibility of your schools and employers by editing the About section on your Timeline. <a href="#" class="learn">Learn more.</a>
        </div>

    </div>
</div>
