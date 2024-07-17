<?php
$heading = "RiosApp";
$isLogged = isLogged();

require view('landing', compact('heading', 'isLogged'));
