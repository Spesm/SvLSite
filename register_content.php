<?php

function secure($inputData)
{
    return htmlspecialchars(stripslashes(trim($inputData)));
}

function showRegisterContent($render = true)
{
    $userName = $userEmail = $password = $passwordRepeat = "";
    $nameAlert = $emailAlert = $passwordAlert = $passwordRepeatAlert = "";
    $formFieldErrorStyle = ' style="background-color: #d1eebe;"';
    $formComplete = false;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["user_name"])) {
            $nameAlert = "Name is required";
        } else {
            $userName = secure($_POST["user_name"]);
            $nameAlert = !preg_match("/^[a-zA-Z-' ]*$/", $userName) ? "Name is not permitted" : $nameAlert;
        }
        if (empty($_POST["email_address"])) {
            $emailAlert = "Email is required";
        } else {
            $userEmail = secure($_POST["email_address"]);
            $emailAlert = !filter_var($userEmail, FILTER_VALIDATE_EMAIL) ? "Email is not valid" : $emailAlert;
        }
        if (empty($_POST["password"])) {
            $passwordAlert = "Password is required";
        } else {
            $password = secure($_POST["password"]);
            $passwordAlert = strlen($password) < 3 ? "Password must at least have three characters" : $passwordAlert;
        }
        if (empty($_POST["password_repeat"])) {
            $passwordRepeatAlert = "Repeat password is required";
        } else {
            $passwordRepeat = secure($_POST["password_repeat"]);
            $passwordRepeatAlert = strlen($password) < 3 || $passwordRepeat != $password ? "Confirmation does not match a valid password" : $passwordRepeatAlert;
        }
        if (!$nameAlert && !$emailAlert && !$passwordAlert && !$passwordRepeatAlert) {
            $formComplete = true;
        }
    }
    if ($render) : ?>
        <?php if (!$formComplete) : ?>
            <div class="content">
                <form method="post" action="index.php">
                    <div class="formfield hidden">
                        <input type="hidden" name="form" value="register">
                    </div>
                    <div class="formfield text">
                        <label for="user_name">Name</label>
                        <input type="text" id="user_name" name="user_name" placeholder="Your Name" <?php echo ($nameAlert ? $formFieldErrorStyle : "") . ($userName ? ' value="' . $userName . '"' : ""); ?>>
                        <?php echo $nameAlert ? '<p class="error">' . $nameAlert . '</p>' : ""; ?>
                    </div>
                    <div class="formfield email">
                        <label for="email_address">Email</label>
                        <input type="email" id="email_address" name="email_address" placeholder="you@mail.com" <?php echo ($emailAlert ? $formFieldErrorStyle : "") . ($userEmail ? ' value="' . $userEmail . '"' : ""); ?>>
                        <?php echo $emailAlert ? '<p class="error">' . $emailAlert . '</p>' : ""; ?>
                    </div>
                    <div class="formfield password">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Your Password" <?php echo ($passwordAlert ? $formFieldErrorStyle : "") . ($password ? ' value="' . $password . '"' : ""); ?>>
                        <?php echo $passwordAlert ? '<p class="error">' . $passwordAlert . '</p>' : ""; ?>
                    </div>
                    <div class="formfield password">
                        <label for="password_repeat">Confirm password</label>
                        <input type="password" id="password_repeat" name="password_repeat" placeholder="Your Password" <?php echo ($passwordRepeatAlert ? $formFieldErrorStyle : "") . ($passwordRepeat ? ' value="' . $passwordRepeat . '"' : ""); ?>>
                        <?php echo $passwordRepeatAlert ? '<p class="error">' . $passwordRepeatAlert . '</p>' : ""; ?>
                    </div>
                    <div class="formfield button">
                        <input type="submit" value="Submit">
                    </div>
                </form>
            </div>
        <?php else : ?>
            <div class="content">
                <p>Congratulations! You have successfully registered.</p>
                <p>You can now login with your username and password.</p>
            </div>
        <?php endif; ?>
    <?php endif;
}