<?php

if (@$_SESSION["user_name"] == "administrator") {
    redirect($windowLocationOrigin . "/dashboard");
    exit;
}