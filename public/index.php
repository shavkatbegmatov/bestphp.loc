<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Repository\UserRepository;

$userRepo = new UserRepository();
$user = $userRepo->find(1);

echo "<pre>";
print_r($user);
echo "</pre>";
