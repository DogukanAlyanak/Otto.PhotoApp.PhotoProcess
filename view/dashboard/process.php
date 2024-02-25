<?php

if (@$_SESSION["user_name"] != "administrator") {
    redirect($windowLocationOrigin . "/login");
    exit;
}