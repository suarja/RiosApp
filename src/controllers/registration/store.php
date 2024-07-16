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

    if ($user) {
        $errors['password'] = 'Wrong email / password combination';
        $errors['email'] = 'Wrong email / password combination';
        require view('registration/register', ['errors' => $errors]);
    } else {
        //? Refactor: add method to User model to create user (User::create)
        $db->query("INSERT INTO Users (email, password) VALUES ('$email', '" . password_hash($password, PASSWORD_DEFAULT) . "')");
        $success = 'User registered successfully';
        redirect("/register");
    }
} else {
    require view('registration/register', ['errors' => $errors]);
}
