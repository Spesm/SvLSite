<?php

unset($_SESSION['username']);
unset($_SESSION['email']);
header('Location:' . HOME . '/home');

function showLogoutContent($render = true)
{
    if ($render) : ?>
        <div class="content">
            <p>Welcome! This is logout.</p>
        </div>
    <?php endif;
}