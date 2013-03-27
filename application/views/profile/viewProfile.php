

<div id="coverPhoto" class="coverPhoto">

    <img src=<?php echo "" . $base . "/" . $images . "/defaultCover.jpg" ?> />
</div>

<div class="profileWrapper fTop mainBlueColor">

    <div class="personDetailProfile fTop">

        <div id="pro">
            <img class="thumbnail pull-left" id="frndpropic" src=<?php echo "" . $base . "/" . $uploads . "/" . $image_path . ""; ?> ></img> </div>

        <span class="profileInfo well pull-left"><?php echo "<span id='frndprofileInfoTextWrapper'class='frndprofileInfoTextWrapper well pull-left'><p class='frndprofileInfoText'><h3>" . $name . "</h3>Birthday:" . $bday . "<br> School:" . $school . "<br>University" . $university . "<br>Employer:" . $employer . "</p></span>" ?> </span> 

        <div class="profileOptions fRight">
            <?php
            if (isset($fid)) {
                echo "<div id='pictureControl' class='btn btn-primary'><a href=" . $base . "/index.php/friends/addFriend?fid=" . $fid . "> Add Friend</a></div>";
            }
            ?> </span>
        </div>
    </div>
    <div id="viewFriends"class="modal hide fade">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Your Friends!</h3>
        </div>
        <div class="modal-body">
            <div class="GalleryImage">
                <a target="_blank" href="klematis_big.htm">
                    <img src="http://fellowshipofminds.files.wordpress.com/2012/04/mickey-mouse-mickey-mouse-29454673-1024-768.jpg" alt="Klematis" width="110" height="90">
                </a>
                <div class="GalleryCaption">Person's Name</div>
            </div>

        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn">Close</a>
        </div>
    </div>


<span class="profileInfo well pull-left"><?php echo "<span id='frndprofileInfoTextWrapper'class='frndprofileInfoTextWrapper well pull-left'><p class='frndprofileInfoText'><h3>".$name."</h3>Birthday:".$bday."<br> School:".$school."<br>University".$university."<br>Employer:".$employer."</p></span>" ?> </span> 

<div class="profileOptions fRight">
 <?php
        if (isset($fid)) {
            echo "<div  class='btn btn-primary'><a href=" . $base . "/index.php/friends/addFriend?fid=" . $fid . "> Add Friend</a></div>";
        }
        ?> </span>
</div>


<div class="wall fLeft">
    <h1> Friends! </h1>
    <?php
    foreach ($friends as $friend) {
        echo "<a href=" . $base . "/index.php/profile/viewProfile?id=" . $friend['friend_id'] . ">" . $friend['friend_first_name'] . "</a>";
        echo '</br>';
    }
    ?>
</div>


</div>


</div>
<div class="clearfix"></div>
<hr>
