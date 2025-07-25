<?php

ob_start(); // Start output buffering.
$isLogged = isLogged();

require base_path("/src/core/App.php");
$db = App::resolve('db');

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];
if (empty($email)) {
    $errors['email'] = 'Email is required';
}
if (empty($password)) {
    $errors['password'] = 'Password is required';
}

if (empty($errors)) {
    $user = $db->query("SELECT * FROM users WHERE email = '$email'")->fetch();
    if (!$user) {
        $errors['password'] = 'Wrong email / password combination';
        $errors['email'] = 'Wrong email / password combination';
        require view('registration/login', ['errors' => $errors, 'isLogged' => $isLogged]);
        exit;
    }

    if (!password_verify($password, $user['password'])) {
        $errors['password'] = 'Wrong email / password combination';
        $errors['email'] = 'Wrong email / password combination';
        require view('registration/login', ['errors' => $errors, 'isLogged' => $isLogged]);
        exit;
    }

    $_SESSION['user'] = [
        'id' => $user['id'], 
        'email' => $user['email'], 
        'username' => $user['username'] ?? '',
        'isLogged' => true
    ];
    header('Location: /');
    exit;
} else {
    require view('registration/login', ['errors' => $errors, 'isLogged' => $isLogged]);
    exit;
}

ob_end_flush(); // End buffering and flush all output to client.
