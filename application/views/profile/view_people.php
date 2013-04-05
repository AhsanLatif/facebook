<br><br>
<div id="searchFilters" class="collapse">
<form name="searchFilters" method="post" action=<?php echo "".$base."/index.php/profile/filteredSearch"?> >
<input type="text" name="city" placeholder="Location" />
<input type="text" name="school" placeholder="School" />
<input type="text" name="uni" placeholder="Highschool" />
<input type="text" name="emp" placeholder="Employer" />
<input type="text" name="fname" placeholder="First Name" />
<input type="text" name="lname" placeholder="Last Name" />
<input type="submit" class="btn btn-small"/>
</div>
<button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#searchFilters">
  Search Filters
</button>
 <br>

<?php
echo "<div class='fTop pull-left' id='searchPageGallery'>";
if($details=="0")
echo "No one matches that description!";
else
{
foreach ($details as $detail) {
    $imageName = $detail['image_name'];
    $id = $detail['user_id'];
    if ($imageName == "") {
        $imageName = "defaultPic.gif";
    }
    if ($id == "") {
        $id = "63";
    }
if ($id != $userid){
    echo "
 <div class='GalleryImage fTop'>
  <a href=" . $base . "/index.php/profile/viewProfile?id=" . $id . ">
  <img src=" . "" . $base . "/" . $uploads . "/" . $imageName . "" . " width='110' height='90' />
  </a>
  <div class='GalleryCaption'>" . $detail['first_name'] . "</div>
</div>";}
}
echo "</div>";
}
?>


<div id="nothing">
</div>
<div class="clearfix">
</div>
<hr>