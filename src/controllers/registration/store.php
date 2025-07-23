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
        require view('registration/register', ['errors' => $errors, 'isLogged' => $isLogged, 'heading' => 'Register']);
    } else {
        //? Refactor: add method to User model to create user (User::create)
        $db->query("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '" . password_hash($password, PASSWORD_DEFAULT) . "')");
        
        // Récupérer l'ID du nouvel utilisateur
        $newUser = $db->query("SELECT * FROM users WHERE email = '$email'")->fetch();
        
        // Connecter automatiquement l'utilisateur
        $_SESSION['user'] = [
            'id' => $newUser['id'], 
            'email' => $newUser['email'], 
            'username' => $newUser['username'],
            'isLogged' => true
        ];
        
        // Rediriger vers la page d'accueil
        header('Location: /');
        exit;
    }
} else {
    require view('registration/register', ['errors' => $errors, 'isLogged' => $isLogged, 'heading' => 'Register']);
}
