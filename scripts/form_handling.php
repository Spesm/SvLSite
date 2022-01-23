<?php

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
        'unspecified' => ucfirst($problem) . ' ' . $subject . ' error',
        'required' => ucfirst($subject) . ' is required',
        'invalid' => ucfirst($subject) . ' is not valid',
        'refused' => ucfirst($subject) . ' is not permitted',
        'strength' => ucfirst($subject) . ' should have at least three characters',
        'failed' => ucfirst($subject) . ' failed',
    ];

    if (array_key_exists($problem, $alerts)) {
        return $alerts[$problem];
    } else {
        return $alerts['unspecified'];
    }
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

function processEmail($postKey, $required = true)
{
    $email = secure(openPost()[$postKey]);
    $alert = '';

    if ($required && !$email) {
        $alert = createAlert('email', 'required');
    } elseif (!validateEmail($email)) {
        $alert = createAlert('email', 'invalid');
    }

    return [$postKey => [
        'value' => $email,
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
        $alert = createAlert('password confirmation', 'failed');
    }

    return [$postKeyTwo => [
        'value' => $password,
        'alert' => $alert,
    ]];
}

function processRegistration()
{
    $output = ['complete' => false];

    $output += processName('user_name');
    $output += processEmail('email_address');
    $output += processPassword('password');
    $output += comparePasswords('password', 'password_repeat');

    if (!implode(array_column($output, 'alert'))) {
        $output['complete'] = true;
        registerUser(array_column($output, 'value'));
    }

    return $output;
}

function registerUser($credentials)
{
    print_r($credentials);
}
