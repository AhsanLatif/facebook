<?php
        foreach ($details as $detail){
//            echo $detail['first_name'];
            echo "<a href=" . $base . "/index.php/profile/viewProfile?id=" . $detail['id'] . ">" . $detail['first_name'] . "</a>"; 
//            <a href="http://www.w3schools.com">Visit W3Schools</a> 
            echo '</br>';
        } 
          
?>
