<?php

function secure($inputData)
{
    return htmlspecialchars(stripslashes(trim($inputData)));
}

function showLoginContent($render = true)
{
    $userEmail = $password = "";
    $emailAlert = $passwordAlert = $loginError = "";
    $formFieldErrorStyle = ' style="background-color: #d1eebe;"';
    $formComplete = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        if (!$emailAlert && !$passwordAlert) {
            if (file_exists(ROOT . '/storage/users.txt')) {
                $userFile = fopen(ROOT . '/storage/users.txt', 'r');
                while (!feof($userFile)) {
                    $users[] = explode('|', fgets($userFile));
                }
                array_shift($users);
            }
            if (isset($users) && in_array($userEmail, array_column($users, 0))) {
                $userPassword = trim($users[array_search($userEmail, array_column($users, 0))][2]);
            }
            if ($password === $userPassword) {
                $_SESSION['username'] = trim($users[array_search($userEmail, array_column($users, 0))][1]);
                $_SESSION['email'] = $userEmail;
                header('Location:' . HOME . '/home');
            } else {
                $loginError = "Invalid combination of email and password";
            }
        }
    }
    if ($render) : ?>
        <?php if (!$formComplete) : ?>
            <div class="content">
                <form method="post" action="./login">
                    <div class="formfield hidden">
                        <input type="hidden" name="form" value="login">
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
                    <?php echo $loginError ? '<p>' . $loginError . '</p>' : ''; ?>
                    <div class="formfield button">
                        <input type="submit" value="Submit">
                    </div>
                </form>
            </div>
        <?php endif; ?>
<?php endif;
}
