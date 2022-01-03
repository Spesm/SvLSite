<?php
    echo "hello there";
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
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
            <div class="content">
                <form>
                    <div class="formfield">
                        <label for="salutation">Salutation</label>
                        <br>
                        <select id="salutation" name="gender">
                            <option value="male">Mr.</option>
                            <option value="female">Ms.</option>
                            <option value="neutral">Mx.</option>
                        </select>
                    </div>
                    <div class="formfield">
                        <label for="user_name">Name</label>
                        <br>
                        <input type="text" id="user_name" name="user_name">
                    </div>
                    <div class="formfield">
                        <label for="email_address">Email</label>
                        <br>
                        <input type="text" id="email_address" name="email_address">
                    </div>
                    <div class="formfield">
                        <label for="telephone_number">Telephone number</label>
                        <br>
                        <input type="text" id="telephone_number" name="telephone_number">
                    </div>
                    <div class="formfield">
                        <label for="communication">Communication</label>
                        <br>
                        <input type="radio" id="email" name="communication" value="email">
                        <label for="email">Email</label>
                        <br>
                        <input type="radio" id="telephone" name="communication" value="telephone">
                        <label for="telephone">Telephone</label>
                    </div>
                    <div class="formfield">
                        <label for="message">Message</label>
                        <br>
                        <textarea id="message" name="message" rows="4"></textarea>
                    </div>
                    <div class="formfield">
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
