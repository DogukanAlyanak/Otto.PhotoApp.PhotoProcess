<?php

header('Content-Type: application/json');
$res['state'] = 'error';
$res['message'] = '400 Bad Request!';
echo json_encode($res);
exit;