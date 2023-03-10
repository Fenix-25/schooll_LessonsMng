<?php

if (session_id() !== null){
    session_start();
}
require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/App/web.php';
