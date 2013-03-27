

<div id="coverPhoto" class="coverPhoto">

    <img src=<?php echo "" . $base . "/" . $images . "/defaultCover.jpg" ?> />
</div>
<div class="profileWrapper fTop mainBlueColor">

    <div id="changeInfo"class="modal hide fade">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Edit Your Info</h3>
        </div>
        <div class="modal-body">
            <form id="editInfo" action=<?php echo "" . $base . "/index.php/profile/updateInfo" ?> method="post">
                <label>School </label><input type="text" name="school" id="school" value=<?php echo $school ?> />
                <label>University </label><input type="text" name="university" id="university" value=<?php echo $university ?> />
                <label>Employer </label><input type="text" name="employer" id="employer" value=<?php echo $employer ?> />
                <input type="hidden" name="id" value=<?php echo $id ?> />
                <label>Birthday </label><input type="text" name="bdate" id="datepicker" value=<?php echo $bday ?> />

        </div>
        <div class="modal-footer">
            <a href="#" class="btn">Close</a>
            <input type="submit" class="btn btn-primary"/>
            </form>
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



    <div id="pictureChange" class="modal hide fade in" style="display: none; ">
        <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>
            <h3>Profile Pic Panel</h3>
        </div>
        <div class="modal-body">

            <div class="tabbable"> <!-- Only required for left/right tabs  -->
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


                        <form name="thumbnail"  method="post" action=<?php echo "" . $base . "/index.php/profile/cropPicture" ?>>
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
                        <p><a href=<?php echo "" . $base . "/index.php/profile/removePic" ?>>Click to remove picture</a></p>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <p>


                        <form enctype="multipart/form-data"  id="profilePicChooser" name="profilePicChooser" method="post" onsubmit="return validatePicUpload();" action=<?php echo "" . $base . "/index.php/profile/profilePhotoUpload" ?>>
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



<div class="wall fTop">
<h1> Post Something! </h1>
<hr>
<form id="Wall" name="Wall">
<input type="hidden" name='id' id='id' value=<?php echo "".$id."" ?> />
<input type="hidden" name="path" id="path"  value=<?php echo "".$base."/index.php/profile/addWallPost"; ?> />
<input type="hidden" name='fid' id='fid' value=<?php echo "".$id."" ?> />
<input type="text" id="post" name="post"/></br>
<input type="button" class="btn" id="buttonPost" value="Post" />
</form>
<div class="helper" >
</div>

        <div id="pro">
            <button type="button" id="pictureChanger" data-toggle="modal" data-target="#pictureChange">Edit</button>
            <img class="thumbnail fLeft" id="propic" src=<?php echo "" . $base . "/" . $uploads . "/" . $image_path . ""; ?>> </div>
        <span class="profileInfo well pull-left"><?php echo "<a data-toggle='modal' data-target='#changeInfo'><span id='profileInfoTextWrapper'class='profileInfoTextWrapper well pull-left'><p class='profileInfoText'><h3>" . $name . "</h3>Birthday:" . $bday . "<br> School:" . $school . "<br>University" . $university . "<br>Employer:" . $employer . "</p></span></a>" ?>

            <div class="profileOptions fRight">
                <img class="fLeft" data-toggle="modal" data-target="#viewFriends" src=<?php echo "" . $base . "/" . $images . "/friends-icon.jpg"; ?> />

            </div>
        </span><br>


    </div>


    <div class="wall fTop">
        <h1> Post Something! </h1>
        <hr>
        <form id="Wall" name="Wall">
            <input type="text" id="wallPost" name="wallPost"/></br>
            <input type="submit" class="btn" value="Post" />
        </form>

        <div class="nothing">
        </div>
    </div>



</div>
    <div class="wall fTop">
        <h1> Post Something! </h1>
        <hr>
        <form id="Wall" name="Wall">
            <input type="text" id="wallPost" name="wallPost"/></br>
            <input type="submit" class="btn" value="Post" />
        </form>

        <div class="nothing">
        </div>
    </div>


<div class="wall fLeft">
    <h1> Friends! </h1>
    <?php
    foreach ($friends as $friend) {
        echo "<a href=" . $base . "/index.php/profile/viewProfile?id=" . $friend['friend_id'] . ">" . $friend['friend_first_name'] . "</a>";
        echo "<div id='pictureControl' class='btn btn-primary'><a href=" . $base . "/index.php/friends/deleteFriend?fid=" . $request['friend_id'] . "> Delete</a></div>";

        echo '</br>';
    }
    ?>
    <h1> Pending Requests! </h1>
    <?php
    foreach ($requests as $request) {
        echo "<a href=" . $base . "/index.php/profile/viewProfile?id=" . $request['friend_id'] . ">" . $request['friend_first_name'] . "</a>";
        echo "<div id='pictureControl' class='btn btn-primary'><a href=" . $base . "/index.php/friends/acceptRequest?fid=" . $request['friend_id'] . "> Accept</a></div>";
        echo "<div id='pictureControl' class='btn btn-primary'><a href=" . $base . "/index.php/friends/ignoreRequest?fid=" . $request['friend_id'] . "> Ignore</a></div>";

        echo '</br>';
    }
    ?>
</div>


</div>


<div class="clearfix"></div>
<hr>
