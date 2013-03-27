
<?php 
echo "<div class='fTop pull-left' id='searchPageGallery'>";
 foreach ($details as $detail){
$imageName=$detail['image_name'];
$id=$detail['user_id'];
if($imageName=="")
{
$imageName="defaultPic.gif";
}
if($id=="")
{$id="63";}

echo "
 <div class='GalleryImage fTop'>
  <a href=".$base . "/index.php/profile/viewProfile?id=" . $id.">
  <img src="."" . $base . "/" . $uploads . "/" . $imageName . ""." width='110' height='90' />
  </a>
  <div class='GalleryCaption'>".$detail['first_name']."</div>
</div>";
}
echo "</div>";
?>


<div id="nothing">
</div>
<div class="clearfix">
</div>
<hr>