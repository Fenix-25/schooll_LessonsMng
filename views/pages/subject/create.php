<?php

use App\Services\Page;

?>

<?php Page::part('header', ['title' => 'Додавання Предмету']); ?>
    <div class="container py-4">
        <div class="p-5 mb-4 bg-light rounded-3">
            <h3>Create new subject</h3>
            <form class="mt-3" action="/create-subject" method="post">
                <div class="row align-items-md-stretch">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Subject name" name="name">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="is_active">
                            <label class="form-check-label" for="flexCheckDefault">
                                Active
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Subject code" name="code">
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
<?php Page::part('footer') ?>