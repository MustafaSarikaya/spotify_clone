<?php
    include ("includes/classes/Account.php");

    $account = new Account();

    include("includes/handlers/register-handler.php");
    include("includes/handlers/login-handler.php");

?>


<html>
<head>
	<title>Welcome to Slotify!</title>
</head>
<body>

	<div id="inputContainer">
		<form id="loginForm" action="register.php" method="POST">
			<h2>Login to your account</h2>
			<p>
				<label for="loginUsername">Username</label>
				<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. bartSimpson" required>
			</p>
			<p>
				<label for="loginPassword">Password</label>
				<input id="loginPassword" name="loginPassword" type="password" placeholder="Enter your password" required>
			</p>

			<button type="submit" name="loginButton">LOG IN</button>
			
		</form>
	</div>

    <div id="inputContainer">
        <form id="loginForm" action="register.php" method="POST">
            <h2>Register Your Free Account</h2>
            <p>
                <?php echo $account->getError("Your username must be between 5 and 25 characters")?>
                <label for="username">Username</label>
                <input id="username" name="username" type="text" placeholder="e.g. bartSimpson" required>
            </p>
            <p>
                <?php echo $account->getError("Your name must be between 2 and 25 characters")?>
                <label for="firstName">First Name</label>
                <input id="firstName" name="firstName" type="text" placeholder="e.g. bart" required>
            </p>
            <p>
                <?php echo $account->getError("Your last name must be between 2 and 25 characters")?>
                <label for="lastName">Last Name</label>
                <input id="lastName" name="lastName" type="text" placeholder="e.g. Simpson" required>
            </p>
            <p>
                <?php echo $account->getError("Emails are not matching")?>
                <?php echo $account->getError("Email is invalid")?>
                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="e.g. bartsimpson@gmail.com" required>
            </p>
            <p>
                <?php echo $account->getError("Emails are not matching")?>
                <label for="confirmEmail">Confirm Email</label>
                <input id="confirmEmail" name="confirmEmail" type="email" placeholder="e.g. bartsimpson@gmail.com" required>
            </p>
            <p>
                <?php echo $account->getError("Passwords are not matching")?>
                <?php echo $account->getError("Passwords must contain characters A-z and digits 0-9")?>
                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="Enter your password" required>
            </p>
            <p>
                <?php echo $account->getError("Passwords are not matching")?>
                <label for="confirmPassword">Confirm Password</label>
                <input id="confirmPassword" name="confirmPassword" type="password" placeholder="Enter your password" required>
            </p>

            <button type="submit" name="registerButton">SIGN UP</button>

        </form>
    </div>


</body>
</html>