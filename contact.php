<?php
    $contactName = $contactEmail = $contactPhone = $contactCommunication = $contactMessage = 'Sem';
    $genderError = $nameError = $emailError = $phoneError = $messageError = true;
    $genderNotification = $nameNotification = $emailNotification = $phoneNotification = $messageNotification = "This field is required";
    $formFieldErrorStyle = ' style="background-color: #d1eebe;"'
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SvLSite</title>
        <link rel="stylesheet" href="./assets/stylesheet.css">
        <meta name="viewport" content="device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="page">
            <div class="header">
                <h1>SvLSite - Home</h1>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="./html/index.html">Home</a></li>
                    <li><a href="./html/about.html">About</a></li>
                    <li><a href="./contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="content">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="formfield select">
                        <label for="salutation">Salutation</label>
                        <select id="salutation" name="gender" <?php echo $genderError ? $formFieldErrorStyle : ""; ?>>
                            <option value="" disabled selected>Please select one</option>
                            <option value="male" <?php echo $gender == "male" ? "selected" : ""; ?>>Mr.</option>
                            <option value="female" <?php echo $gender == "female" ? "selected" : ""; ?>>Ms.</option>
                            <option value="neutral" <?php echo $gender == "neutral" ? "selected" : ""; ?>>Mx.</option>
                        </select>
                        <?php echo $genderError ? '<p class="error">' . $genderNotification . '</p>' : ""; ?>
                    </div>
                    <div class="formfield text">
                        <label for="user_name">Name</label>
                        <input type="text" id="user_name" name="user_name" placeholder="Your Name" <?php echo ($nameError ? $formFieldErrorStyle : "") . ($contactName ? ' value="' . $contactName . '"' : ""); ?>>
                        <?php echo $nameError ? '<p class="error">' . $nameNotification . '</p>' : ""; ?>
                    </div>
                    <div class="formfield text">
                        <label for="email_address">Email</label>
                        <input type="text" id="email_address" name="email_address" placeholder="you@mail.com" <?php echo ($emailError ? $formFieldErrorStyle : "") . ($contactEmail ? ' value="' . $contactEmail . '"' : ""); ?>>
                        <?php echo $emailError ? '<p class="error">' . $emailNotification . '</p>' : ""; ?>
                    </div>
                    <div class="formfield text">
                        <label for="telephone_number">Telephone number</label>
                        <input type="text" id="telephone_number" name="telephone_number" placeholder="0611223344" <?php echo ($phoneError ? $formFieldErrorStyle : "") . ($contactPhone ? ' value="' . $contactPhone . '"' : ""); ?>>
                        <?php echo $phoneError ? '<p class="error">' . $phoneNotification . '</p>' : ""; ?>
                    </div>
                    <div class="formfield radiogroup">
                        <label for="communication">Communication</label>
                        <div class="radio">
                            <input type="radio" id="email" name="communication" value="email" <?php echo $contactCommunication != "telephone" ? ' checked="checked"' : ""; ?>>
                            <label for="email">Email</label>
                        </div>
                        <div class="radio">
                            <input type="radio" id="telephone" name="communication" value="telephone" <?php echo $contactCommunication == "telephone" ? ' checked="checked"' : ""; ?>>
                            <label for="telephone">Telephone</label>
                        </div>
                    </div>
                    <div class="formfield textarea">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="4" <?php echo $messageError ? $formFieldErrorStyle : ""; ?>><?php echo $contactMessage ?></textarea>
                        <?php echo $messageError ? '<p class="error">' . $messageNotification . '</p>' : ""; ?>
                    </div>
                    <div class="formfield button">
                        <input type="submit" value="Submit">
                    </div>
                </form>
            </div>
            <div class="footer">
                <footer>
                    <p>&copy 2021 SvL</p>
                </footer>
            </div>
        </div>
    </body>
</html>
