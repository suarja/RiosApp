<?php
$isLogged = isLogged();
$heading = "Register";
require view('registration/register', compact('isLogged', 'heading'));
