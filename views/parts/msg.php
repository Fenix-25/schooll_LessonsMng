<?php if (!empty($_SESSION['notify']['info'])): ?>
    <div class="toast-container p-3 bottom-0 end-0">
        <div class="toast toast-custom align-items-center text-bg-<?= $_SESSION['notify']['info']['style'] ?> border-0"
             role="alert"
             aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= $_SESSION['notify']['info']['msg'] ?>
                </div>
                <button type="submit" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php endif; ?>
