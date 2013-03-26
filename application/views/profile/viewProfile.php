

<div id="coverPhoto" class="coverPhoto">

<img src=<?php echo "".$base."/".$images."/defaultCover.jpg" ?> />
</div>

<div class="profileWrapper fTop mainBlueColor">





<div class="personDetailProfile fTop">

<div id="pro">
<img class="thumbnail pull-left" id="frndpropic" src=<?php echo "" . $base . "/" . $uploads . "/" . $image_path ."";?> ></img> </div>

<span class="profileInfo well pull-left"><?php echo "<span id='frndprofileInfoTextWrapper'class='frndprofileInfoTextWrapper well pull-left'><p class='frndprofileInfoText'><h3>".$name."</h3>Birthday:".$bday."<br> School:".$school."<br>University".$university."<br>Employer:".$employer."</p></span>" ?> </span> 

<div class="profileOptions fRight">
 <?php
        if (isset($fid)) {
            echo "<div id='pictureControl' class='btn btn-primary'><a href=" . $base . "/index.php/friends/addFriend?fid=" . $fid . "> Add Friend</a></div>";
        }
        ?> </span>
</div>

<br>


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


</div>
<div class="clearfix"></div>
<hr>
