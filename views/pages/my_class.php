<?php

use App\Controllers\User;
use App\Services\Page;

?>

<?php Page::part('header', ['title' => 'My class']); ?>
    <div class="container py-4">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Мій клас</h1>
                <p class="col-md-8 fs-4">Девіз нашого класу: ...</p>
            </div>
        </div>
        <div class="row align-items-md-stretch">
			<?php foreach ($class as $student): ?>
                <div class="col-md-6">
                    <div class="h-100 p-5 text-bg-dark rounded-3">
                        <span class="me-2 avatar" style='background-image: url("<?= $student['avatar'] ?>")'></span>
                        <h2 class="<?= User::noActive($student['is_active']) ?>"><?= $student['first_name'] . " " . $student['name'] . " " . $student['surname'] ?></h2>
                        <p></p>
                        <button class="btn btn-outline-light" type="button">Example button</button>
                    </div>
                </div>
			<?php endforeach; ?>
        </div>

        <footer class="pt-3 mt-4 text-muted border-top">
            © 2022
        </footer>
    </div>
<?php Page::part('footer') ?>