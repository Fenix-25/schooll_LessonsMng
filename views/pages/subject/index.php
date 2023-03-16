<?php

use App\Services\Page;

?>

<?php Page::part('header', ['title' => 'Subjects']); ?>
	<div class="container py-4">
		<div class="p-5 mb-4 bg-light rounded-3">
			<div class="container-fluid py-5">
				<h1 class="display-5 fw-bold">Subjects page</h1>
				<p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
				<a  href="/create-subject" class="btn btn-primary btn-lg" type="button">Add new subject</a>
			</div>
		</div>
	</div>
<?php Page::part('footer') ?>