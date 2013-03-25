
<?php
if ($school == "")
    $school = "n/a";
if ($university == "")
    $university = "n/a";
if ($employer == "")
    $employer = "n/a";
?>
<input type="text" data-provide="typeahead" id="tA" data-source=<?php echo json_encode($arr) ?> />

<div id="coverPhoto" class="coverPhoto">

    <img src=<?php echo "" . $base . "/" . $images . "/defaultCover.jpg" ?> />
</div>
<div class="profileWrapper fTop mainBlueColor">



    <div id="infoEditor" class="modal hide fade">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Edit your info</h3>
        </div>
        <div class="modal-body">
            <div>

                <form name="infoEdit" id="infoEdit">
                    <label> School 
                        <input name="School" type="text" value=<?php echo "" . $school . "" ?> /></label>
                    <label> University
                        <input name="University" type="text"    value=<?php echo "" . $university . "" ?>  /> </label>
                    <label> Employer
                        <input name="Employer" type="text"   value=<?php echo "" . $employer . "" ?>  /> </label>
                    <label> Birthday 
                        <input id="datepicker" type="text" value=<?php echo "" . $bday . "" ?> name="Bdate"    enabled="false"/></label>
                </form>

            </div>

        </div>
        <div class="modal-footer">
            <a href="#" class="btn">Close</a>
            <a href="#" class="btn btn-primary">Save changes</a>
        </div>
    </div>
    <!--- -->




    <div id="pictureChange" class="modal hide fade in" style="display: none; ">
        <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>
            <h3>Profile Pic Panel</h3>
        </div>
        <div class="modal-body">

            <div class="tabbable"> <!-- Only required for left/right tabs -->


            </div>
            <div class="modal-footer">


                <a href="#" class="btn" data-dismiss="modal">Ok</a>
            </div>
        </div>
    </div>

    <!--Start of page -->



    <div class="personDetailProfile fTop">
        <?php
        if (isset($fid)) {
            echo "<div id='pictureControl' class='btn btn-primary'><a href=" . $base . "/index.php/friends/addFriend?fid=" . $fid . "> Add Friend</a></div>";
        }
        ?>
        <span class="profileInfo well pull-left"><?php echo "<a  data-toggle='modal' href='#infoEditor'><span  id='profileInfoTextWrapper'class='profileInfoTextWrapper well pull-left'><p class='profileInfoText'><h3>" . $name . "</h3>Birthday:" . $bday . "<br> School:" . $school . "<br>University:" . $university . "<br>Employer:" . $employer . "</p></span></a>" ?>

            <div class="profileOptions fRight">
                <img class="fLeft" src=<?php echo "" . $base . "/" . $images . "/friends-icon.jpg"; ?> />

            </div>
        </span><br>
        <div id="pro">
            <img class="thumbnail fLeft" id="propic" src=<?php echo "" . $base . "/" . $uploads . "/" . $image_path . ""; ?> />
        </div>

    </div>

    <div class="wall fTop">
        <h1> Post Something! </h1>
        <hr>
        <form id="Wall" name="wall">
            <input type="text" id="wallPost" name="wallPost"/></br>
            <input type="submit" class="btn" value="Post" />
        </form>
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


<div class="clearfix"></div>
<hr>
