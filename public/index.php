<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Repository\UserRepository;
use App\Repository\RoleRepository;
use App\Repository\PermissionRepository;
use App\Repository\ModuleRepository;

$userRepo = new UserRepository();
$roleRepo = new RoleRepository();
$permRepo = new PermissionRepository();
$moduleRepo = new ModuleRepository();

print_r($userRepo->all());
print_r($roleRepo->all());
print_r($permRepo->all());
print_r($moduleRepo->all());

// // require_once __DIR__ . '/../vendor/autoload.php';

// use App\Repository\UserRepository;

// $userRepo = new UserRepository();
// $user = $userRepo->find(1);

// echo "<pre>";
// print_r($user);
// echo "</pre>";
