<div id="viewLargePic"class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h3>Picture Viewer </h3>
    </div>

    <div class="modal-body">
        <input type="hidden" id="clickedPic" />
        <img id="picLargeView" src="" alt="picture" width='250' height='400'/>
    </div>
    <div class="modal-footer">
        <a href="#" data-dismiss="modal" class="btn">Close</a>
    </div>
</div>

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
            <input type="submit" class="btn" value="post" id="simplePost" />
        </div>

        <div class="tab-pane" id="tab2">
            <div class="collapse in" id="dropper" >

                <label> Drop Photos here or click to upload </label>
                <form action=<?php echo "" . $base . "/index.php/newsfeed/uploadPhoto"; ?> class="dropzone"id="dropFiles">

                    <label>Caption </label><input type="text" id='PicText' placeholder="Add a caption before you drop your photo!" name="PicText" />
                </form>
            </div>
            <div id="normal-toggle-button">

                <input type="button" value="drop" data-toggle="collapse" data-target="#dropper" id="doneDragging" />
            </div>
        </div>	

        <div class="tab-pane" id="tab3">
            <form class="cssform" name="property" id="property" method="POST" action="<?php echo base_url() ?>index.php/newsfeed/add_video"  enctype="multipart/form-data" >
                <table>
                    <tr>
                        
                        <label>Caption </label><input type="text" id='VidText' placeholder="Add a caption before you select your video!" name="VidText" />
                        <td>Select Video :</td>
                        <td><input type="file" id="video" name="video" ></td>
                    </tr>
                    <tr>
                        <td> <input type="submit" class="btn" id="button" name="submit" value="Submit" /></td>
                    </tr>
                </table>
            </form>
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

