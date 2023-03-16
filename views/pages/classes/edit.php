<?php

use App\Services\Helper;
use App\Services\Page;

?>

<?php Page::part('header', ['title' => 'Редвагування класу']); ?>
    <div class="container py-4">
        <div class="p-5 mb-4 bg-light rounded-3">
            <h3>Додати нового учня в клас</h3>
            <form class="mt-3" action="/create-class" method="post">
                <div class="row align-items-md-stretch">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" min="1" max="11" class="form-control" placeholder="Приклад класу: 10-Б"
                                   name="number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Приклад коду: 10-b" name="code">
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Зберегти</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="accordion accordion-flush rounded-3" id="accordionFlushExample">
					<?php ?>
					<?php foreach ($students as $student): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-heading<?= $student['id'] ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapse<?= $student['id'] ?>" aria-expanded="false"
                                        aria-controls="flush-collapse<?= $student['id'] ?>">
                                    <?= $student['first_name'] . " " . $student['name'] ." ". $student['surname'] ?>
                                </button>
                            </h2>
                            <div id="flush-collapse<?= $student['id'] ?>" class="accordion-collapse collapse"
                                 aria-labelledby="flush-heading<?= $student['id'] ?>" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <ul class="list-group">
                                                <li class="list-group-item">Email: <?= $student['email'] ?></li>
                                                <li class="list-group-item">Login: <?= $student['login'] ?></li>
                                                <li class="list-group-item">Birthday: <?= Helper::showFormatDate($student['birthday']) ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					<?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
<?php Page::part('footer') ?>