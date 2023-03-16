<?php

use App\Controllers\Subject;
use App\Controllers\User;
use App\Services\Page;

$activeSubjects = Subject::allActiveSubjects();
$subjects = Subject::allSubjects();
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
                <h2>Активні предмети</h2>
				<?php foreach ($activeSubjects as $activeSubject): ?>
                    <p><?= $activeSubject['name'] ?></p>
				<?php endforeach; ?>
                <a href="/show-homework" class="btn btn-outline-light" type="button">Домашня робота</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="h-100 p-5 bg-light border rounded-3">
                <h2>Всі предети  </h2>
                <a  href="/create-subject" class="mb-4 btn btn-info badge" type="button">Добавити новиий прредмет</a>
                    <ul class="list-group">
				<?php foreach ($subjects as $subject): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           <?= $subject['name'] ?>
                            <form action="/edit-subject" method="post">
                                <input type="hidden" name="id_subject" value="<?= $subject['id'] ?>">
                                <button class="btn btn-primary badge bg-primary rounded-pill">Edit</button>
                            </form>
                        </li>
				<?php endforeach; ?>
                    </ul>
            </div>
        </div>
    </div>


</div>
<?php Page::part('footer') ?>
