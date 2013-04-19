


<?php
if(isset($friends))
{
 $i=0;
 $frends=array();
        foreach ($friends as $friend): {
           $frends[$i]= $friend['friend_first_name'] ;
		   $i=$i+1;
       
        }endforeach;
        }
		else{
		$frends="";}
		?>
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
			
            <h3>Your Friends!   <input type="text" name="SearchBox" id="searchFrend" data-items="4" class="search-query" placeholder="Search" data-provide="typeahead" data-source=<?php echo json_encode($frends); ?> autocomplete="off" />
			<button id="searchFriends" class="btn btn-small" /> Search</button>
</h3>
	
        </div>
        <div class="modal-body">
		<div id="randomDiv" >
      
                <?php
                foreach ($friends as $friend) {
				echo "<div class='GalleryImage fTop'>";
                    echo" <a href=" . $base . "/index.php/profile/viewProfile?id=" . $friend['friend_id'] . ">" . "<img src='" . $base . "/" . $uploads . "/" . $friend['image_name'] . "' alt='nothing' width='110' height='90'></a>";
                    echo "<div class='GalleryCaption'>".$friend['friend_first_name'] . "</div>";
                echo "</div>";
				}
                ?>
			
			
            
			</div>

        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn">Close</a>
        </div>
    </div>



    <div id="pictureChange" class="modal hide fade in" style="display: none; ">
        <div class="modal-header">
            <a class="close" data-dismiss="modal">�</a>
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


    <div class="personDetailProfile fTop">

        <div id="pro">
            <button type="button" id="pictureChanger" data-toggle="modal" data-target="#pictureChange">Edit</button>
            <img class="thumbnail fLeft" id="propic" src=<?php echo "" . $base . "/" . $uploads . "/" . $image_path . ""; ?> > </div>
        <span class="profileInfo well pull-left"><?php echo "<a data-toggle='modal' data-target='#changeInfo'><span id='profileInfoTextWrapper'class='profileInfoTextWrapper well pull-left'><p class='profileInfoText'><h3>" . $name . "</h3>Birthday:" . $bday . "<br> School:" . $school . "<br>University" . $university . "<br>Employer:" . $employer . "</p></span></a>" ?>

          
			<div id="frendIcon" class="profileOptions">
			<div class="btn-group">
  <a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#">
    Options
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    <li ><a data-toggle="modal" data-target="#viewFriends">View Friends </a></li>
	    <li ><a href=<?php echo "".$base."/index.php/profile/goToPage/newsfeed";?>>View Newsfeed </a></li>
		<li> <a href=<?php echo "".$base."/index.php/profile/logout"; ?>> Logout </a> </li>
  </ul>
</div>
                </br>
            </div>
        </span><br>


    </div>

<h3> <u>My Friends</u> </h3>
<div class="hoverbox">

		
      
                <?php
                foreach ($friends as $friend) {
			
                    echo"<li> <a href=" . $base . "/index.php/profile/viewProfile?id=" . $friend['friend_id'] . ">" . "<img src='" . $base . "/" . $uploads . "/" . $friend['image_name'] . "' alt='nothing' width='110' height='90' /></a>";
                    echo "<div class='GalleryCaption'>".$friend['friend_first_name'] . "</div></li>";
             
				}
                ?>
			
			
            
		

</div>
 
        


</div>


<div class="clearfix"></div>
<hr>
