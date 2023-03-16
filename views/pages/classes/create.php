<?php

use App\Services\Page;

?>

<?php Page::part('header', ['title' => 'Створення класу']); ?>
	<div class="container py-4">
		<div class="p-5 mb-4 bg-light rounded-3">
			<h3>Створення нового класу</h3>
            <form class="mt-3" action="/create-class" method="post">
                <div class="row align-items-md-stretch">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" min="1" max="11" class="form-control" placeholder="Приклад класу: 10-Б" name="number">
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

	</div>
<?php Page::part('footer') ?>