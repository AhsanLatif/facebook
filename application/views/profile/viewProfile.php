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

<div id="coverPhoto" class="coverPhoto">

    <img src=<?php echo "" . $base . "/" . $images . "/defaultCover.jpg" ?> />
</div>

<div class="profileWrapper fTop mainBlueColor">
    <div class="personDetailProfile fTop">

        <div id="pro">
            <div class="clearfix"></div>


            <img class="thumbnail pull-left" id="frndpropic" src=<?php echo "" . $base . "/" . $uploads . "/" . $image_path . ""; ?> /> </div>

        <span class="profileInfo well pull-left"><?php echo "<span id='frndprofileInfoTextWrapper'class='frndprofileInfoTextWrapper well pull-left'><p class='frndprofileInfoText'><h3>" . $name . "</h3>Birthday:" . $bday . "<br> School:" . $school . "<br>University" . $university . "<br>Employer:" . $employer . "</p></span>" ?> 

            <div class="profileOptions fRight">
                <img class="fLeft" id="frendIcon" data-toggle="modal" data-target="#viewFriends" src=<?php echo "" . $base . "/" . $images . "/friends-icon-mutual.gif"; ?> />

                <?php
                if (isset($reqsent)) {
                    echo "<a  id='addFrendButton' class='btn btn-primary' href='#'> Request Pending </a>";
                }
                if (isset($friend)) {
//                echo "<a  id='addFrendButton' class='btn btn-primary' href=" . $base . "/index.php/friends/addFriend?fid=" . $fid . "> Add Friend </a>";
                }
                if (isset($fid)) {
                    echo "<a  id='addFrendButton' class='btn btn-primary link' href=" . $base . "/index.php/friends/addFriend?fid=" . $fid . "> Add Friend </a>";
                }
                ?>

        </span>
    </div>
</div>
<br>

<div class="wall fTop">
    <h1> Post Something! </h1>
    <hr>
    <form id="Wall" name="Wall">
        <input type="hidden" name='id' id='id' value=<?php echo "" . $id . "" ?> /> 
        <input type="hidden" name="path" id="path"  value=<?php echo "" . $base . "/index.php/profile/addWallPost"; ?> />
        <input type="hidden" name='fid' id='fid' value=<?php echo "" . $myID . "" ?> />
        <input type="text" id="post" name="post"/></br>
        <input type="button" class="btn" id="buttonPost" value="Post" />
    </form>
    <div id="thePosts">
        <div class="helper" >
        </div>
        <?php
        $i = 0;
        if (isset($wallPost) && $wallPost != 0) {
            foreach ($wallPost as $post) {
                echo "<div class='postWall'> <p>" . $post['first_name'] . " " . $post['last_name'] . ": " . $post['post'] . "</p></div>";
                $i++;
            }
        }
        ?>
    </div>
    <div class="nothing">
    </div>
</div>
</div>
<div class="clearfix"></div>
<hr>
<br>


<div class="clearfix"></div>
<hr>
