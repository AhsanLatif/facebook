<div id="loggedInNav">

<div  id="pendingRequests" class="dropdown">
  <img data-toggle="dropdown" src=<?php echo "" . $base . "/" . $images . "/friends-icon.gif" ?> />
  <ul class="dropdown-menu pull-left">
    <li><a href="#">Action</a></li>
    <li><a  href="#">Another action</a></li>
    <li><a  href="#">   </a></li>
	 <li><a  href="#">   </a></li>
	  <li><a  href="#">   </a></li>
   
  </ul>
</div>
<div class="dropdown" id="notifications">
  <button data-toggle="dropdown" > ! </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" >
  <span id="noList"> </span>
	  <li><a  href="#">   </a></li>
	 <li><a  href="#">   </a></li>
	  <li><a  href="#">   </a></li>
   
  </ul>
</div>
<input type="hidden" name='currid' id='currid' value=<?php echo $id ?> />
<input type="hidden" name="path" id="path"  value=<?php echo "".$base."/index.php/profile"; ?> />

  <div id="searchButton"><a onclick="searchProfileHead.submit();"><img src=<?php echo "" . $base . "/" . $images . "/search.png"; ?> /> </a></div>

<?php
if(isset($friends))
{
 $i=0;
 $frends=array();
        foreach ($friends as $friend) {
           $frends[$i]= $friend['friend_first_name'] ;
		   $i=$i+1;
       
        }
        };
		$frends="junk";?>
<form class="fTop"class="navbar-search pull-left" method="post"id="searchProfileHead" action=<?php echo "".$base."/index.php/profile/Search" ?> >
  <input type="text" name="SearchBox" id="search" data-items="4" class="search-query" placeholder="Search" data-provide="typeahead" data-source=<?php echo json_encode($frends); ?> autocomplete="off" />
  </form>

<div id="clearfix"></div>
<div id="logOut" class="fTop"><a class="btn"class="fTop" href=<?php echo "".$base."/index.php/profile/logout"?>> Log Out </a></div>

</div>