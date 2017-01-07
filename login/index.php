<?php
require_once("./membersite_config.php");



if(isset($_POST['submitted']))
{
	
	
	if($fgmembersite->Login()) {
		$fgmembersite->RedirectToURL("../index.php");
	}
	
	
}



?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>BoxManager</title>
        <link rel="icon" href="favicon.png" />
        <script src="../js/jquery.min.js"></script>
        <script src="../js/skel.min.js"></script>
        <script src="../js/skel-layers.min.js"></script>
        <script src="../js/init.js"></script>
        <link rel="stylesheet" href="../css/skel.css" />
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="../css/style-xlarge.css" />
    </head>

    <body>

        <header id="header" class="skel-layers-fixed">
            <a href="<?php 
            echo json_decode(file_get_contents('configs/config.json'), true)['Site Main']; 
            ?>
            "><img src="images/logo.png" height="43" width="43"></img>
                <?php echo json_decode(file_get_contents("configs/config.json"), true)["Site Name"];?>
            </a>
            <nav id="nav">
                <ul>
                    <?php
if(!$login){
	
	
	echo <<<A
	<li><a href="../signup/">Sign up</a></li>
	<li><a href="./">Login</a></li>
A;
	
	
} else {
	
	
	echo <<<A
	<li>Welcome back, {
		
		$fgmembersite->UserFullName()
	}
	
	</li>
	<li><a href="add/">Add resource</a></li>
A;
	
	
}


?>
                </ul>
            </nav>
        </header>

        <section id="one" class="wrapper style1">
            <header class="major">
                <div class="container">
                    <div class="row">
                        <center style="width: 100%;">
                            <div class='4u'>
                                <section class='special box'>
                                    <form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
                                        <fieldset>

                                            <input type='hidden' name='submitted' id='submitted' value='1' />

                                            <div class='short_explanation'>* required fields</div>
                                            <input type='hidden' class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName();?>' id='<?php echo $fgmembersite->GetSpamTrapInputName();?>' />

                                            <div><span class='error'><?php echo $fgmembersite->GetErrorMessage();?></span></div>
                                                <label for='username'>Username*:</label>
                                                <input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay(' username ') ?>' maxlength="50" />
                                                <span id='login_username_errorloc' class='error'></span><br>
                                                <label for='password'>Password*:</label>
                                                <input type='password' name='password' id='password' maxlength="50" />
                                                <div id='login_password_errorloc' class='error' style='clear:both'></div>
                                            </div>


                                                <input type='submit' name='Submit' value='Submit' />
                                            </div>

                                        </fieldset>
                                    </form>


                                    <script type='text/javascript'>
                                        // <![CDATA[
                                        var pwdwidget = new PasswordWidget('thepwddiv', 'password');
                                        pwdwidget.MakePWDWidget();

                                        var frmvalidator = new Validator("login");
                                        frmvalidator.EnableOnPageErrorDisplay();
                                        frmvalidator.EnableMsgsTogether();

                                        frmvalidator.addValidation("username", "req", "Please provide a username");

                                        frmvalidator.addValidation("password", "req", "Please provide a password");

                                        // ]]>
                                    </script>
                                </section>
                            </div>
                        </center>
                    </div>
                </div>
            </header>
        </section>

    </body>

    </html>