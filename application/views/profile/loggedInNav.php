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
<div id="loggedInNav">

<div  id="pendingRequests" class="dropdown">
  <img data-toggle="dropdown" src=<?php echo "" . $base . "/" . $images . "/friends-icon.gif"; ?> />
  <ul class="dropdown-menu"> 

            <?php
            if (isset($requests)) {
                foreach ($requests as $request): {
                    echo "<li><a href="."" . $base . "/index.php/profile/viewProfile?id=" . $request['user_id'] ."". ">" . $request['friend_first_name'] . "</a></li>";
                    
                }endforeach;
            }
			else
			{
			echo "  <li> No Requests </li>";
			}
            ?>
        </ul>
</div>
<!--<div class="dropdown" id="notifications">
  <button data-toggle="dropdown" > ! </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" >
<span id="noList">
</span>
   
  </ul>
</div>-->
 <div id="nameHolder"><a href=<?php echo "".$base."/index.php/profile"?> > <?php echo $name ?> </a></div>
<input type="hidden" name='currid' id='currid' value=<?php echo $id ?> />
<input type="hidden" name="path" id="path"  value=<?php echo "".$base."/index.php/profile"; ?> />
  <div id="searchButton"><a onclick="searchProfileHead.submit();"><img src=<?php echo "" . $base . "/" . $images . "/search.png"; ?> /> </a></div>


<form class="navbar-search pull-left" method="post" id="searchProfileHead" action=<?php echo "".$base."/index.php/profile/Search" ?> >
  <input type="text" name="SearchBox" id="search" data-items="4" class="search-query" placeholder="Search" data-provide="typeahead" data-source=<?php echo json_encode($frends); ?> autocomplete="off" />
  </form>

 
<div id="clearfix"></div>


<div id="logOut">

<div class="btn-group">
  <a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#">
    Options
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
	    <li ><a href=<?php echo "".$base."/index.php/profile/goToPage/newsfeed";  ?> >View Newsfeed </a></li>
		<li> <a href=<?php echo "".$base."/index.php/profile/logout"; ?>> Logout </a> </li>

  </ul>
</div>
</div>

</div>
