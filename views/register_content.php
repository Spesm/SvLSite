<?php

require_once ROOT . '/scripts/form_handling.php';

function showRegisterContent($render = true)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input = processRegistration();
        $formFieldErrorStyle = 'style="background-color: #d1eebe;"';
    }
    if ($render) : ?>
        <?php if (!isset($input) || !$input['complete']) : ?>
            <div class="content">
                <form method="post" action="./register" novalidate>
                    <div class="formfield hidden">
                        <input type="hidden" name="form" value="register">
                    </div>
                    <div class="formfield text">
                        <label for="username">Name</label>
                        <input type="text" id="username" name="username" placeholder="Your Name" <?php echo (isset($input) && $input['username']['alert'] ? $formFieldErrorStyle : "") . (isset($input['username']['value']) ? ' value="' . $input['username']['value'] . '"' : ""); ?>>
                        <?php echo isset($input['username']['alert']) ? '<p class="error">' . $input['username']['alert'] . '</p>' : ""; ?>
                    </div>
                    <div class="formfield email">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="you@mail.com" <?php echo (isset($input) && $input['email']['alert'] ? $formFieldErrorStyle : "") . (isset($input['email']['value']) ? ' value="' . $input['email']['value'] . '"' : ""); ?>>
                        <?php echo isset($input['email']['alert']) ? '<p class="error">' . $input['email']['alert'] . '</p>' : ""; ?>
                    </div>
                    <div class="formfield password">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Your Password" <?php echo (isset($input) && $input['password']['alert'] ? $formFieldErrorStyle : "") . (isset($input['password']['value']) ? ' value="' . $input['password']['value'] . '"' : ""); ?>>
                        <?php echo isset($input['password']['alert']) ? '<p class="error">' . $input['password']['alert'] . '</p>' : ""; ?>
                    </div>
                    <div class="formfield password">
                        <label for="password_repeat">Confirm password</label>
                        <input type="password" id="password_repeat" name="password_repeat" placeholder="Your Password" <?php echo (isset($input) && $input['password_repeat']['alert'] ? $formFieldErrorStyle : "") . (isset($input['password_repeat']['value']) ? ' value="' . $input['password_repeat']['value'] . '"' : ""); ?>>
                        <?php echo isset($input['password_repeat']['alert']) ? '<p class="error">' . $input['password_repeat']['alert'] . '</p>' : ""; ?>
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
