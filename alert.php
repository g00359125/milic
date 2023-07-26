<?php
    if(isset($_SESSION['alert'])) :
?>

    <div class="alert alert-<?=$_SESSION['alert_style']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['alert']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php 
    unset($_SESSION['alert']);
    endif;
?>