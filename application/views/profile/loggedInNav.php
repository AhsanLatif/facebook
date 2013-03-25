<div id="loggedInNav">


<div class="dropdown" id="notifications">
  <button data-toggle="dropdown" > ! </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
    <li><a tabindex="-1" href="#">Action</a></li>
    <li><a tabindex="-1" href="#">Another action</a></li>
    <li><a tabindex="-1" href="#">Something else here</a></li>
   
  </ul>
</div>

<form class="fTop"class="navbar-search pull-left" method="post"id="searchProfileHead" action=<?php echo "".$base."/index.php/profile/Search" ?> >
  <input type="text" name="SearchBox" class="search-query" placeholder="Search" />
</form>
<div id="clearfix"></div>
<div id="logOut" class="fTop"><a class="btn"class="fTop" href=<?php echo "".$base."/index.php/profile/logout"?>> Log Out </a></div>

</div>