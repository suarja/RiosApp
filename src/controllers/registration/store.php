<?php

require base_path("/src/core/App.php");

$db = App::resolve('db');
$isLogged = isLogged();


$email = $_POST['email'];
$password = $_POST['password'];
$username = $_POST['username'] ?? '';

$errors = [];
if (empty($email)) {
    $errors['email'] = 'Email is required';
}
if (empty($password)) {
    $errors['password'] = 'Password is required';
}
if (empty($username)) {
    $errors['username'] = 'Username is required';
}

if (empty($errors)) {
    //? Refactor: add method to User model to find user by email (User::findByEmail)
    $user = $db->query("SELECT * FROM users WHERE email = '$email'")->fetch();

    if ($user) {
        $errors['password'] = 'Wrong email / password combination';
        $errors['email'] = 'Wrong email / password combination';
        require view('registration/register', ['errors' => $errors]);
    } else {
        //? Refactor: add method to User model to create user (User::create)
        $db->query("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '" . password_hash($password, PASSWORD_DEFAULT) . "')");
        $success = 'User registered successfully';
        redirect("/register");
    }
} else {
    require view('registration/register', ['errors' => $errors]);
}
