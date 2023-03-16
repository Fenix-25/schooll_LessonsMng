<?php

use App\Controllers\Subject;
use App\Controllers\User;
use App\Controllers\Users\Teacher;
use App\Services\Page;

$subjects = []//Subject::allForClass();
?>

<?php Page::part('header', ['title' => 'Dashboard']); ?>
    <div class="container py-4">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Вітаю в системі <?= User::session()['name'] ?>!</h1>
            </div>
        </div>
        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <div class="h-100 p-5 text-bg-dark rounded-3">
                    <h2>Твої предмети</h2>
					<?php foreach ($subjects as $subject): ?>
                        <p><?= $subject['name'] ?></p>
					<?php endforeach; ?>
                    <a href="/show-homework" class="btn btn-outline-light" type="button">Домашня робота</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2>Класний керівник</h2>
                    <p><?php //Teacher::classTeacher(User::session()['class']); ?></p>
                    <button class="btn btn-outline-secondary" type="button">Example button</button>
                </div>
            </div>
        </div>

        <footer class="pt-3 mt-4 text-muted border-top">
            © 2022
        </footer>
    </div>
<?php Page::part('footer') ?>