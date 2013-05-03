<input type="hidden" id="session" value=<?php echo $id ?> />

<!-- body -->	
<div class="fTop">
    <div class="tabbable"> <!-- Only required for left/right tabs  -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">Status/Link</a></li>
            <li><a href="#tab2" data-toggle="tab">Photo</a></li>
            <li><a href="#tab3" data-toggle="tab">Video</a></li>
        </ul>
    </div>
    <div id="clearfix"></div>
    <div class="tab-content" >
        <div class="tab-pane active" id="tab1">
            <input type="text" name="statusPost" id="statusPost" />
            <input type="submit" class="btn" value="post" id="simplePost" /><div id="linkloading" > <img src=<?php echo "" . $base . "/" . $images . "/loading.gif" . ""; ?> /></div>
		
        </div>

        <div class="tab-pane" id="tab2">
            <div class="collapse in" id="dropper" >

                <label> Drop Photos here or click to upload </label>
                <form action=<?php echo "" . $base . "/index.php/newsfeed/uploadPhoto"; ?> class="dropzone"id="dropFiles">
<div class="fallback">
    <input name="file" type="file" multiple />
  </div>
                    <label>Caption </label><input type="text" id='PicText' placeholder="Add a caption before you drop your photo!" name="PicText" />
                </form>
            </div>
            <div id="normal-toggle-button">

                <input type="button" value="drop" data-toggle="collapse" data-target="#dropper" id="doneDragging" />
            </div>
        </div>	

        <div class="tab-pane" id="tab3">
		<div class="collapse in" id="Vdropper">
		     <label> Drop Videos here or click to upload </label>
                <form action="<?php echo base_url() ?>index.php/newsfeed/add_video"  enctype="multipart/form-data"  class="dropzone"id="dropVFiles">
				<label>Caption </label><input type="text" id='VidText' placeholder="Add a caption before you select your video!" name="VidText" />
<div class="fallback">
   <input type="file" id="video" name="video" >
  </div>
                        <td> <input type="submit" class="btn" id="button" name="submit" value="Submit" /></td>
                 
            </form>
        </div>	
		<div id="normal-toggle-button">

                <input type="button" value="drop" data-toggle="collapse" data-target="#Vdropper" id="doneVDragging" />
            </div>
		    </div>

			</div>

    <hr>
    <input type="hidden" id="currId" value="0" />
    <div id="theWall">

        <div id="newPostAdder" ></div>

    </div>
</div>
<div id="clearfix">
</div>

