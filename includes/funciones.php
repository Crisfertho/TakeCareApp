<?php

function debug($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function s($html) : string {
    $s = htmlspecialchars($html, ENT_QUOTES, 'UTF-8');
    return $s; 
}

function isLast(string $actual, string $next) {
    if($actual !== $next) {
        return true;
    } 
    return false;
}

//verificar usuario autenticado
function isAuth() {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function isAdmin() {
    if(!isset($_SESSION['admin'])) {
        header('Location: /');
    }
}