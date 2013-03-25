
<?php
$to = "someone@example.com";
$subject = "Welcome to Facebook";
$message = "Please Click The Link Below To Confirm Your Account\n"."<a href='http://localhost/webProject/index.php/process/emailConfirmation/".md5($to)."'>Click Here</a>";
$from = "someonelse@example.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "Mail Sent.\n".$message;
?>
