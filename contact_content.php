<?php

function secure($inputData)
{
    return htmlspecialchars(stripslashes(trim($inputData)));
}

function showContactContent($render = true)
{
    $contactGender = $contactName = $contactEmail = $contactPhone = $communication = $contactMessage = "";
    $genderAlert = $nameAlert = $emailAlert = $phoneAlert = $messageAlert = "";
    $formFieldErrorStyle = ' style="background-color: #d1eebe;"';
    $formComplete = false;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["gender"])) {
            $genderAlert = "Salutation is required";
        } else {
            $contactGender = secure($_POST["gender"]);
        }
        if (empty($_POST["user_name"])) {
            $nameAlert = "Name is required";
        } else {
            $contactName = secure($_POST["user_name"]);
            $nameAlert = !preg_match("/^[a-zA-Z-' ]*$/", $contactName) ? "Name is not permitted" : $nameAlert;
        }
        if (empty($_POST["email_address"])) {
            $emailAlert = "Email is required";
        } else {
            $contactEmail = secure($_POST["email_address"]);
            $emailAlert = !filter_var($contactEmail, FILTER_VALIDATE_EMAIL) ? "Email is not valid" : $emailAlert;
        }
        if (empty($_POST["telephone_number"])) {
            $phoneAlert = "Telephone number is required";
        } else {
            $contactPhone = secure($_POST["telephone_number"]);
            $phoneAlert = !is_numeric($contactPhone) || strlen($contactPhone) <> 10 ? "Telephone number is not valid" : $phoneAlert;
        }
        $communication = secure($_POST["communication"]);
        if (empty($_POST["message"])) {
            $messageAlert = "Message is required";
        } else {
            $contactMessage = secure($_POST["message"]);
        }
        switch ($contactGender) {
            case "male":
                $salutation = "Mr.";
                break;
            case "female":
                $salutation = "Ms.";
                break;
            default:
                $salutation = "Mx.";
        }
        if (!$genderAlert && !$nameAlert && !$emailAlert && !$phoneAlert && !$messageAlert) {
            $formComplete = true;
        }
    }
    if ($render) : ?>
        <?php if (!$formComplete) : ?>
            <div class="content">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="formfield hidden">
                        <input type="hidden" name="form" value="contact">
                    </div>
                    <div class="formfield select">
                        <label for="salutation">Salutation</label>
                        <select id="salutation" name="gender" <?php echo $genderAlert ? $formFieldErrorStyle : ""; ?>>
                            <option value="" disabled selected>Please select one</option>
                            <option value="male" <?php echo $contactGender == "male" ? "selected" : ""; ?>>Mr.</option>
                            <option value="female" <?php echo $contactGender == "female" ? "selected" : ""; ?>>Ms.</option>
                            <option value="neutral" <?php echo $contactGender == "neutral" ? "selected" : ""; ?>>Mx.</option>
                        </select>
                        <?php echo $genderAlert ? '<p class="error">' . $genderAlert . '</p>' : ""; ?>
                    </div>
                    <div class="formfield text">
                        <label for="user_name">Name</label>
                        <input type="text" id="user_name" name="user_name" placeholder="Your Name" <?php echo ($nameAlert ? $formFieldErrorStyle : "") . ($contactName ? ' value="' . $contactName . '"' : ""); ?>>
                        <?php echo $nameAlert ? '<p class="error">' . $nameAlert . '</p>' : ""; ?>
                    </div>
                    <div class="formfield email">
                        <label for="email_address">Email</label>
                        <input type="email" id="email_address" name="email_address" placeholder="you@mail.com" <?php echo ($emailAlert ? $formFieldErrorStyle : "") . ($contactEmail ? ' value="' . $contactEmail . '"' : ""); ?>>
                        <?php echo $emailAlert ? '<p class="error">' . $emailAlert . '</p>' : ""; ?>
                    </div>
                    <div class="formfield tel">
                        <label for="telephone_number">Telephone number</label>
                        <input type="tel" id="telephone_number" name="telephone_number" placeholder="0611223344" <?php echo ($phoneAlert ? $formFieldErrorStyle : "") . ($contactPhone ? ' value="' . $contactPhone . '"' : ""); ?>>
                        <?php echo $phoneAlert ? '<p class="error">' . $phoneAlert . '</p>' : ""; ?>
                    </div>
                    <div class="formfield radiogroup">
                        <label for="communication">Communication</label>
                        <div class="radio">
                            <input type="radio" id="email" name="communication" value="email" <?php echo $communication != "telephone" ? ' checked="checked"' : ""; ?>>
                            <label for="email">Email</label>
                        </div>
                        <div class="radio">
                            <input type="radio" id="telephone" name="communication" value="telephone" <?php echo $communication == "telephone" ? ' checked="checked"' : ""; ?>>
                            <label for="telephone">Telephone</label>
                        </div>
                    </div>
                    <div class="formfield textarea">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="4" <?php echo $messageAlert ? $formFieldErrorStyle : ""; ?>><?php echo $contactMessage ?></textarea>
                        <?php echo $messageAlert ? '<p class="error">' . $messageAlert . '</p>' : ""; ?>
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
                        <?php echo "<p>Name: " . $salutation . " " . $contactName . "</p>"; ?>
                        <?php echo "<p>Email: " . $contactEmail . "</p>"; ?>
                        <?php echo "<p>Telephone: " . $contactPhone . "</p>"; ?>
                    </div>
                    <?php echo "<p>Contact by " . $communication . "</p>"; ?>
                    <p>Your message:</p>
                    <div class="message">
                        <?php echo "<p>" . $contactMessage . "</p>"; ?>
                    </div>
                </div>
                <p>Thanks for your input!</p>
            </div>
        <?php endif; ?>
    <?php endif;
}
