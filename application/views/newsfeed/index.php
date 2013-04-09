

			
			<div class="tabbable"> <!-- Only required for left/right tabs  -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">Status/Link</a></li>
                    <li><a href="#tab2" data-toggle="tab">Photo</a></li>
                    <li><a href="#tab3" data-toggle="tab">Video</a></li>
                </ul>
			</div>
			
  <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
						<input type="text" name="statusPost" id="statusPost" />
					</div>
				 
                    <div class="tab-pane" id="tab2">
					<div class="collapse in" id="dropper" >
					<label> Drop Photos here or click to upload </label>
					  <form action=<?php echo "".$base."/index.php/newsfeed/uploadPhoto"; ?> class="dropzone"id="dropFiles">
					  
					 
					</form>
					</div>
					<div id="normal-toggle-button">

					 <input type="button" value="drop" data-toggle="collapse" data-target="#dropper" id="doneDragging" />
					</div>
                    </div>		
			
   </div>
   <hr>
   <div id="theWall">
   <div class="aPost">
  
   <img class="aPostimg" src=<?php echo "".$base."/".$images."/logout_button.gif" ?> /><br><br><p>The text</p>
   </div>
   
   </div>
		
		