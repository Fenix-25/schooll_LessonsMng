<?php

use App\Services\Page;

Page::part('header', ['title' => 'Register'])
?>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">Vertically centered hero sign-up form</h1>
                <p class="col-lg-10 fs-4">Below is an example form built entirely with Bootstrap’s form controls. Each
                    required form group has a validation state that can be triggered by attempting to submit the form
                    without completing it.</p>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-5 border rounded-3 bg-light" action="auth/register" method="post" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                        <label for="name">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
                        <label for="email">Email address</label>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="image">Upload</label>
                        <input type="file" class="form-control" id="image" name="avatar">
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                               name="password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password confirm"
                               name="passwordConfirm">
                        <label for="floatingPassword">Password confirm</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
                </form>
            </div>
        </div>
    </div>
<?php Page::part('footer') ?>