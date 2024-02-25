<?php

/* Redirect */
function redirect($e) {
    header('Location: ' . $e, true, 301);
    return;
}