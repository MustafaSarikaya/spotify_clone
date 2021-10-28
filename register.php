<?php

//    namespace spotify_clone\register;

    ini_set( 'error_reporting', E_ALL );
    ini_set( 'display_errors', true );

//    use includes\classes\Account;
    ob_start();
    session_start();
    $timezone = date_default_timezone_set("America/Toronto");
    $con = mysqli_connect("localhost", "root", "", "slotify");

    if(mysqli_connect_errno()){
        echo "Failed to connect: " . mysqli_connect_errno();
    }
    include 'includes/Config.php';
    include 'includes/classes/Account.php';

    $account = new Account($con);
    if(isset($_POST['registerButton'])){
        $un = $this->sanitizeUsername($_POST['username']);
        $fn = $this->sanitizeString($_POST['firstName']);
        $ln = $this->sanitizeString($_POST['lastName']);
        $em = $this->sanitizeString($_POST['email']);
        $em2= $this->sanitizeString($_POST['confirm_email']);
        $pw = $this->sanitizePassword($_POST['password']);
        $pw2 = $this->sanitizePassword($_POST['confirm_password']);
        $wasSuccessful = $account->register($un, $em, em2, $pw,$pw2, $fn, $ln);

        if($wasSuccessful){
            $_SESSION['userLoggedIn']= $un;
            header("Location: index.php");
        }
    }

    if(isset($_POST['loginButton'])){
        $un = $_POST['loginUsername'];
        $pw = $_POST['loginPassword'];

        $result = $account->login($un,$pw);
        if($result){
            $_SESSION['userLoggedIn']= $un;
            header("Location: index.php");
        }
    }

   function sanitizeUsername($input){
        $input = strip_tags($input);
        str_replace(" ", "", $input);
        return $input;
    }

    function sanitizePassword($input){
        $input = strip_tags($input);
        return $input;
    }

    function sanitizeString($input){
        $input = strip_tags($input);
        $input = str_replace(" ", "", $input);
        $input = ucfirst(strtolower($input));
        return $input;
    }
?>


<html>
<head>
	<title>Welcome to Slotify!</title>

    <link rel="stylesheet" type="text/css" href="assets/css/register.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>
<?php

if(isset($_POST['registerButton'])) {
    echo '<script>
				$(document).ready(function() {
					$("#loginForm").hide();
					$("#registerForm").show();
				});
			</script>';
}
else {
    echo '<script>
				$(document).ready(function() {
					$("#loginForm").show();
					$("#registerForm").hide();
				});
			</script>';
}

?>


<div id="background">

    <div id="loginContainer">

        <div id="inputContainer">
            <form id="loginForm" action="register.php" method="POST">
                <h2>Login to your account</h2>
                <p>
                    <?php echo $account->getError("Your username or password is incorrect."); ?>
                    <label for="loginUsername">Username</label>
                    <input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. bartSimpson" value="<?php getInputValue('loginUsername') ?>" required>
                </p>
                <p>
                    <label for="loginPassword">Password</label>
                    <input id="loginPassword" name="loginPassword" type="password" placeholder="Your password" required>
                </p>

                <button type="submit" name="loginButton">LOG IN</button>

                <div class="hasAccountText">
                    <span id="hideLogin">Don't have an account yet? Signup here.</span>
                </div>

            </form>



            <form id="registerForm" action="register.php" method="POST">
                <h2>Create your free account</h2>
                <p>
                    <?php  echo $account->getError("Your username must be between 5 and 25 characters") ?>
                    <?php  echo $account->getError("This username already exists") ?>
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" placeholder="e.g. bartSimpson" value="<?php getInputValue('username') ?>" required>
                </p>

                <p>
                    <?php echo $account->getError("Your name must be between 2 and 25 characters") ?>
                    <label for="firstName">First name</label>
                    <input id="firstName" name="firstName" type="text" placeholder="e.g. Bart" value="<?php getInputValue('firstName') ?>" required>
                </p>

                <p>
                    <?php  echo $account->getError("Your last name must be between 2 and 25 characters") ?>
                    <label for="lastName">Last name</label>
                    <input id="lastName" name="lastName" type="text" placeholder="e.g. Simpson" value="<?php getInputValue('lastName') ?>" required>
                </p>

                <p>
                    <?php  echo $account->getError("Emails are not matching") ?>
                    <?php  echo $account->getError("Email is invalid") ?>
                    <?php  echo $account->getError("This email already in use") ?>
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue('email') ?>" required>
                </p>

                <p>
                    <label for="email2">Confirm email</label>
                    <input id="email2" name="email2" type="email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue('email2') ?>" required>
                </p>

                <p>
                    <?php  echo $account->getError("Passwords are not matching") ?>
                    <?php  echo $account->getError("Passwords must contain characters A-z and digits 0-9") ?>
                    <?php echo $account->getError("Password must be between 5 and 30 characters"); ?>
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" placeholder="Your password" required>
                </p>

                <p>
                    <label for="password2">Confirm password</label>
                    <input id="password2" name="password2" type="password" placeholder="Your password" required>
                </p>

                <button type="submit" name="registerButton">SIGN UP</button>

                <div class="hasAccountText">
                    <span id="hideRegister">Already have an account? Log in here.</span>
                </div>

            </form>


        </div>

        <div id="loginText">
            <h1>Get great music, right now</h1>
            <h2>Listen to loads of songs for free</h2>
            <ul>
                <li>Discover music you'll fall in love with</li>
                <li>Create your own playlists</li>
                <li>Follow artists to keep up to date</li>
            </ul>
        </div>

    </div>
</div>

</body>
</html>
