<?php

require_once ROOT . '/scripts/form_handling.php';

function showContactContent($render = true)
{   
    $input = ['complete' => false];
    if (isset($_SESSION['username'])) {
        $input += ['username' => ['value' => $_SESSION['username']]];
        $input += ['email' => ['value' => $_SESSION['email']]];
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input = processContact();
        $formFieldErrorStyle = ' style="background-color: #d1eebe;"';
    }
    if ($render) : ?>
        <?php if (!$input['complete']) : ?>
            <div class="content">
                <form method="post" action="./contact" novalidate>
                    <div class="formfield hidden">
                        <input type="hidden" name="form" value="contact">
                    </div>
                    <div class="formfield select">
                        <label for="salutation">Salutation</label>
                        <select id="salutation" name="gender" <?php echo !empty($input['gender']['alert']) ? $formFieldErrorStyle : ""; ?>>
                            <option value="" disabled selected>Please select one</option>
                            <option value="male" <?php echo isset($input['gender']) && $input['gender']['value'] == "male" ? "selected" : ""; ?>>Mr.</option>
                            <option value="female" <?php echo isset($input['gender']) && $input['gender']['value'] == "female" ? "selected" : ""; ?>>Ms.</option>
                            <option value="neutral" <?php echo isset($input['gender']) && $input['gender']['value'] == "neutral" ? "selected" : ""; ?>>Mx.</option>
                        </select>
                        <?php echo isset($input['gender']['alert']) ? '<p class="error">' . $input['gender']['alert'] . '</p>' : ""; ?>
                    </div>
                    <div class="formfield text">
                        <label for="username">Name</label>
                        <input type="text" id="username" name="username" placeholder="Your Name" <?php echo (!empty($input['username']['alert']) ? $formFieldErrorStyle : "") . (isset($input['username']['value']) ? ' value="' . $input['username']['value'] . '"' : ""); ?>>
                        <?php echo isset($input['username']['alert']) ? '<p class="error">' . $input['username']['alert'] . '</p>' : ""; ?>
                    </div>
                    <div class="formfield email">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="you@mail.com" <?php echo (!empty($input['email']['alert']) ? $formFieldErrorStyle : "") . (isset($input['email']['value']) ? ' value="' . $input['email']['value'] . '"' : ""); ?>>
                        <?php echo isset($input['email']['alert']) ? '<p class="error">' . $input['email']['alert'] . '</p>' : ""; ?>
                    </div>
                    <div class="formfield tel">
                        <label for="number">Telephone number</label>
                        <input type="tel" id="number" name="number" placeholder="0611223344" <?php echo (!empty($input['number']['alert']) ? $formFieldErrorStyle : "") . (isset($input['number']['value']) ? ' value="' . $input['number']['value'] . '"' : ""); ?>>
                        <?php echo isset($input['number']['alert']) ? '<p class="error">' . $input['number']['alert'] . '</p>' : ""; ?>
                    </div>
                    <div class="formfield radiogroup">
                        <label for="communication">Communication</label>
                        <div class="radio">
                            <input type="radio" id="email" name="communication" value="email" <?php echo !isset($input['communication']) || $input['communication']['value'] == "email" ? ' checked="checked"' : ""; ?>>
                            <label for="email">Email</label>
                        </div>
                        <div class="radio">
                            <input type="radio" id="telephone" name="communication" value="telephone" <?php echo isset($input['communication']) && $input['communication']['value'] == "telephone" ? ' checked="checked"' : ""; ?>>
                            <label for="telephone">Telephone</label>
                        </div>
                    </div>
                    <div class="formfield textarea">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="4" <?php echo isset($input['message']['alert']) ? $formFieldErrorStyle : ""; ?>><?php echo isset($input['message']) ? $input['message']['value'] : ""; ?></textarea>
                        <?php echo isset($input['message']['alert']) ? '<p class="error">' . $input['message']['alert'] . '</p>' : ""; ?>
                    </div>
                    <div class="formfield button">
                        <input type="submit" value="Submit">
                    </div>
                </form>
            </div>
        <?php else : ?>
            <div class="content">
                <p>Thank you! Your message was successfully posted.</p>
                <p>Your details:</p>
                <div class="response">
                    <div class="details">
                        <?php echo "<p>Name: " . $input['gender']['value'] . " " . $input['username']['value'] . "</p>"; ?>
                        <?php echo "<p>Email: " . $input['email']['value'] . "</p>"; ?>
                        <?php echo "<p>Telephone: " . $input['number']['value'] . "</p>"; ?>
                    </div>
                    <?php echo "<p>Contact by " . $input['communication']['value'] . "</p>"; ?>
                    <p>Your message:</p>
                    <div class="message">
                        <?php echo "<p>" . $input['message']['value'] . "</p>"; ?>
                    </div>
                </div>
                <p>Thanks for your input!</p>
            </div>
        <?php endif; ?>
    <?php endif;
}
