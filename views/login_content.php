<?php

require_once ROOT . '/scripts/form_handling.php';

function showLoginContent($render = true)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input = processLogin();
        $formFieldErrorStyle = 'style="background-color: #d1eebe;"';
    }
    if ($render) : ?>
        <div class="content">
            <form method="post" action="./login" novalidate>
                <div class="formfield hidden">
                    <input type="hidden" name="form" value="login">
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
                <?php echo isset($input['login_error']) ? '<p>' . $input['login_error'] . '</p>' : ''; ?>
                <div class="formfield button">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    <?php endif;
}
