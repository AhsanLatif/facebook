
<?php
if(isset($mutualfriends))
{
 $i=0;
 $frends=array();
        foreach ($mutualfriends as $friend): {
           $frends[$i]= $friend['friend_first_name'] ;
		   $i=$i+1;
       
        }endforeach;
        }
		else{
		$frends="";}
		?>

   <input type="hidden" name='myID' id='myID' value=<?php echo "" . $myID . "" ?> />
<div id="viewFriends"class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Mutual Friends! <input type="text" name="SearchBox" id="searchMFrend" data-items="4" class="search-query" placeholder="Search" data-provide="typeahead" data-source=<?php echo json_encode($frends); ?> autocomplete="off" />
			<button id="searchMutualFriends" class="btn btn-small" /> Search</button></h3>
    </div>
    <div class="modal-body">
        <div id="randomDivM">
            <?php
            foreach ($mutualfriends as $friend1) {
               echo "<div class='GalleryImage fTop'>";
                    echo" <a href=" . $base . "/index.php/profile/viewProfile?id=" . $friend1['friend_id'] . ">" . "<img src='" . $base . "/" . $uploads . "/" . $friend1['image_name'] . "' alt='nothing' width='110' height='90'></a>";
                    echo "<div class='GalleryCaption'>".$friend1['friend_first_name'] . "</div>";
                echo "</div>";}
            ?>
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

            <div class="profileOptions" >
                <img class="fLeft" id="frendIcon" data-toggle="modal" data-target="#viewFriends" src=<?php echo "" . $base . "/" . $images . "/friends-icon-mutual.gif"; ?> />

                <?php
                if (isset($reqaccept)) {
                    echo "<a  id='addFrendButton' class='btn btn-primary link' onclick='javascript:hideIgnore();' href=" . $base . "/index.php/friends/acceptRequest?fid=" . $fid . "> Accept Request </a>";
					
                    echo "<a  id='addFrendButton' class='btn btn-primary link12' href=" . $base . "/index.php/friends/ignoreRequest?fid=" . $fid . "> Ignore Request </a>";
                } else if (isset($friend)) {
                    echo "<a  id='addFrendButton' class='btn btn-primary link' href=" . $base . "/index.php/friends/deleteFriend?fid=" . $fid . "> Delete Friend </a>";
                } else if (isset($reqsent)) {
                    echo "<a  id='addFrendButton' class='btn btn-primary link' href='#'> Request Pending </a>";
                } else if (isset($abc)) {
                    echo "<a  id='addFrendButton' class='btn btn-primary link' href=" . $base . "/index.php/friends/addFriend?fid=" . $fid . "> Add Friend </a>";
                }
                ?>
	</div>
        </span>
    </div>
</div>
<br>
<!--
<div class="wall fTop">
    <h1> Post Something! </h1>
    <hr>
    <form id="Wall" name="Wall">
        <input type="hidden" name='id' id='id' value=<?php echo "" . $id . "" ?> /> 
     
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
-->