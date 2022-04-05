<?php

use Models\User;

function openPost()
{
    return filter_input_array(INPUT_POST);
}

function secure($inputData)
{
    return htmlspecialchars(stripslashes(trim($inputData)));
}

function createAlert($subject = 'input', $problem = 'unspecified')
{
    $alerts = [
        'unspecified'   => ucfirst($problem) . ' ' . $subject . ' error',
        'required'      => ucfirst($subject) . ' is required',
        'invalid'       => ucfirst($subject) . ' is not valid',
        'incorrect'     => ucfirst($subject) . ' must have ten numeral digits',
        'duplicate'     => ucfirst($subject) . ' is already registered',
        'refused'       => ucfirst($subject) . ' is not permitted',
        'strength'      => ucfirst($subject) . ' must have at least three characters',
        'mismatch'      => ucfirst($subject) . ' does not match the original input',
        'failed'        => ucfirst($subject) . ' failed with this email and password',
    ];

    if (array_key_exists($problem, $alerts)) {
        return $alerts[$problem];
    } else {
        return $alerts['unspecified'];
    }
}

function processGender($postKey, $required = true)
{
    $gender = array_key_exists($postKey, openPost()) ? secure(openPost()[$postKey]) : '';
    $alert = '';

    if ($required && !$gender) {
        $alert = createAlert('salutation', 'required');
    }

    return [$postKey => [
        'value' => $gender,
        'alert' => $alert,
    ]];
}

function validateName($name)
{
    return preg_match("/^[a-zA-Z-' ]*$/", $name);
}

function processName($postKey, $required = true)
{
    $name = secure(openPost()[$postKey]);
    $alert = '';

    if ($required && !$name) {
        $alert = createAlert('name', 'required');
    } elseif (!validateName($name)) {
        $alert = createAlert('name', 'refused');
    }

    return [$postKey => [
        'value' => $name,
        'alert' => $alert,
    ]];
}

function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function processEmail($postKey, $required = true, $unique = true)
{
    $email = secure(openPost()[$postKey]);
    $alert = '';

    if ($required && !$email) {
        $alert = createAlert('email', 'required');
    } elseif (!validateEmail($email)) {
        $alert = createAlert('email', 'invalid');
    } elseif ($unique && in_array($email, User::getUsedEmails())) {
        $alert = createAlert('email', 'duplicate');
    }

    return [$postKey => [
        'value' => $email,
        'alert' => $alert,
    ]];
}

function validateTelephone($number)
{
    return is_numeric($number) && strlen($number) === 10;
}

function processTelephone($postKey, $required = true)
{
    $number = secure(openPost()[$postKey]);
    $alert = '';

    if ($required && !$number) {
        $alert = createAlert('telephone number', 'required');
    } elseif (!validateTelephone($number)) {
        $alert = createAlert('telephone number', 'incorrect');
    }

    return [$postKey => [
        'value' => $number,
        'alert' => $alert,
    ]];
}

function processCommunication($postKey)
{
    $communication = secure(openPost()[$postKey]);

    return [$postKey => [
        'value' => $communication,
    ]];
}

function processMessage($postKey, $required = true)
{
    $message = secure(openPost()[$postKey]);
    $alert = '';

    if ($required && !$message) {
        $alert = createAlert('message', 'required');
    }

    return [$postKey => [
        'value' => $message,
        'alert' => $alert,
    ]];
}

function validatePassword($password)
{
    return strlen($password) < 3 ? false : true;
}

function processPassword($postKey, $required = true)
{
    $password = secure(openPost()[$postKey]);
    $alert = '';

    if ($required && !$password) {
        $alert = createAlert('password', 'required');
    } elseif (!validatePassword($password)) {
        $alert = createAlert('password', 'strength');
    }

    return [$postKey => [
        'value' => $password,
        'alert' => $alert,
    ]];
}

function comparePasswords($postKeyOne, $postKeyTwo, $required = true)
{
    $password = secure(openPost()[$postKeyOne]);
    $passwordRepeat = secure(openPost()[$postKeyTwo]);
    $alert = '';

    if ($required && !$passwordRepeat) {
        $alert = createAlert('password confirmation', 'required');
    } elseif (!validatePassword($passwordRepeat)) {
        $alert = createAlert('password', 'strength');
    } elseif ($passwordRepeat != $password) {
        $alert = createAlert('password confirmation', 'mismatch');
    }

    return [$postKeyTwo => [
        'value' => $passwordRepeat,
        'alert' => $alert,
    ]];
}

function processLogin()
{
    $output = ['complete' => false];

    $output += processEmail('email', 1, 0);
    $output += processPassword('password');

    if (!implode(array_column($output, 'alert'))) {
        $output['complete'] = true;
        $output += loginUser($output['email']['value'], $output['password']['value']);
    }

    return $output;
}

function loginUser($email, $password)
{
    $user = User::getUserBy($email);

    if (!$user || $user['password'] !== $password) {
        $alert = createAlert('login', 'failed');
        return ['login_error' => $alert];
    } else {
        $_SESSION['username'] = $user['name'];
        $_SESSION['email'] = $email;
        header('Location:' . HOME . '/home');
    }
}

function processRegistration()
{
    $output = ['complete' => false];

    $output += processName('username');
    $output += processEmail('email');
    $output += processPassword('password');
    $output += comparePasswords('password', 'password_repeat');

    if (!implode(array_column($output, 'alert'))) {
        $output['complete'] = true;
        registerUser(array_column($output, 'value'));
    }

    return $output;
}

function registerUser($userData)
{
    $user = [
        'username' => $userData[0],
        'email' => $userData[1],
        'password' => $userData[2],
    ];

    User::create($user);
}

function processContact()
{
    $output = ['complete' => false];

    $output += processGender('gender');
    $output += processName('username');
    $output += processEmail('email', 1, 0);
    $output += processTelephone('number');
    $output += processCommunication('communication');
    $output += processMessage('message');

    if (!implode(array_column($output, 'alert'))) {
        $output['complete'] = true;
    }

    return $output;
}
