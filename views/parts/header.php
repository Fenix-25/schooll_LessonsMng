<?php

use App\Controllers\User;
use App\Services\Page;
use App\Services\Session;


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title><?= $title ?? "Page no found!" ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/style.css">
    <link rel="shortcut icon" href="/assets/favicon.ico" type="image/x-icon">
</head>
<body class="bg-dark text-secondary">
<header class="p-3 text-bg-secondary ">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <i class="fa fa-home"></i>
            </a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 text-white">Home</a></li>
            </ul>
            <div class="text-end">
				<?php if (!Session::auth()): ?>
                    <a class="btn btn-outline-light me-2" href="/login">Login</a>
                    <a class="btn btn-warning" href="/register">Sign-up</a>
				<?php else: ?>
                    <ul class="nav nav-pills justify-content-center align-item-center">
                        <li class="nav-item">
                            <a href="<?= Page::link() ?>"
                               class="nav-link text-white <?= Page::active(Page::link()) ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="/subjects"
                               class="nav-link text-white  <?= Page::active('/subjects') ?>">Subjects</a>
                        </li>

						<?php if (User::session()['role'] === 'director'): ?>
                            <li class="nav-item">
                                <a href="/classes"
                                   class="nav-link text-white <?= Page::active('/classes') ?>">Classes</a>
                            </li>
						<?php else: ?>
                            <li class="nav-item">
                                <a href="/my-class"
                                   class="nav-link text-white <?= Page::active('/my-class') ?>">My class</a>
                            </li>
						<?php endif; ?>
                        <li>
                            <div class="dropdown mt-1" style="margin-left: 10px">
                                <a href="#"
                                   class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                   data-bs-toggle="dropdown" aria-expanded="false">
									<?php Page::part('img', ['src' => User::avatar('avatar')]) ?>
                                    <strong><?= User::session()['name'] ?></strong>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="auth/logout" method="post">
                                            <button class="dropdown-item" type="submit">Sign out</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
				<?php endif; ?>
            </div>
        </div>
    </div>
</header>