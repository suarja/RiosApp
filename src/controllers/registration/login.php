<?php
$isLogged = isLogged();
$heading = "Login";
require view('registration/login', compact('isLogged', 'heading'));
