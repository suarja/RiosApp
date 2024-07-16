<?php

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
    //? Refactor: add method to User model to find user by email (User::findByEmail)
    $user = $db->query("SELECT * FROM Users WHERE email = '$email'")->fetch();
    if (!$user) {
        $errors['password'] = 'Wrong email / password combination';
        $errors['email'] = 'Wrong email / password combination';
        require view('registration/login', ['errors' => $errors]);
        exit;
    }
    //? Refactor validation to use Class Validator
    if (!password_verify($password, $user['password'])) {
        $errors['password'] = 'Wrong email / password combination';
        $errors['email'] = 'Wrong email / password combination';
        require view('registration/login', ['errors' => $errors]);
        exit;
    }

    $_SESSION['user'] = ['id' => $user['id'], 'email' => $user['email'], 'isLogged' => true];
    redirect('/players');
    exit;
} else {
    require view('registration/login', ['errors' => $errors]);
    exit;
}
