

<div id="loginForm">

    <form name="loginForm" class="navbar-form" method="POST" action=<?php echo "" . $base . "/index.php/home/login" ?>>
        <table>
            <tr>
                <td>
                    Email or Phone
                </td>
                <td>
                    Password
                </td>
            </tr>

            <tr>
                <td>
                    <input type="text" name="loginEmail" id="loginEmail" />
                </td>
                                  
                <td>
                    <input type="password" name="loginPassword" id="loginPassword"/>
                </td>
                <td>
                    <input class="btn-premium" type="submit" id="submitButtonLogin" value="Log In"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label><input name="rememberMe" id="rememberMe" type="checkbox"/>Remember Me</label>
                </td>
                <td>
                    <a href=<?php echo "".$base."/index.php/process/goToPage/resetPassword"?>/>Forgot Your Password? </a>
                </td>
				<td>
				  <div class="alert-error"><?php
                    if (isset($invalididpassword)) {
                        echo $invalididpassword;
						$invaldidpassword="oogabooga";
						unset($invalididpassword);
                    }
					
                    ?></div>
				</td>
            </tr>

        </table>



    </form>


</div>