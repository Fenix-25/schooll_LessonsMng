<?php

use App\Controllers\Classes;
use App\Services\Page;
?>
<?php Page::part('header', ['title' => 'Classes']); ?>
<div class="container py-4">
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <div class="row">
                <div class="col-12">
                    <a href="/create-class" class="btn btn-outline-primary mb-4">Сворити клас</a>
                </div>
            </div>
			<div class="row">
				<?php foreach ($classes as $class): ?>
                   <div class="col-4 mb-4">
                       <div class="card">
                           <div class="card-body">
                               <h5 class="card-title"><?= $class['number'] ?></h5>
                               <p>Кількість учнів в класі: <?= Classes::CounterStudentsOfClass($class['id']) ?? "0"?></p>
                               <a href="/all-students-of-class" class="card-link btn btn-info">Учні класу</a>
                               <?php if (Classes::CounterStudentsOfClass($class['id']) > 0):  ?>
                                   <a href="/edit-class?id=<?= $class['id'] ?>" class="card-link btn btn-warning">Редагувати</a>
                               <?php else: ?>
                                   <a href="/add-new-student?id=<?= $class['id'] ?>" class="card-link btn btn-outline-secondary">Добавити нового учня</a>
                               <?php endif; ?>
                               <?php ?>

                           </div>
                       </div>
                   </div>
				<?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php Page::part('footer') ?>
