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
    // check if the user exists
    $user = $db->query("SELECT * FROM Users WHERE email = '$email'")->fetch();

    if ($user) {
        $errors['password'] = 'Wrong email / password combination';
        $errors['email'] = 'Wrong email / password combination';
        require view('registration/register', ['errors' => $errors]);
    } else {
        // register the user
        $db->query("INSERT INTO Users (email, password) VALUES ('$email', '" . password_hash($password, PASSWORD_DEFAULT) . "')");
        $success = 'User registered successfully';
        redirect("/players");
    }
} else {
    require view('registration/register', ['errors' => $errors]);
}
