<?php include_once 'includes/header.php'

/** @var array $news */
?>

<div>
    <h1 class="title mt-4 mb-4"><?= $news['name'] ?></h1>

    <a class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="/news/">Вернуться</a>

    <div class="mt-4">
        <p>
           <?= $news['detail'] ?>
        </p>
    </div>
</div>

<?php include_once 'includes/footer.php'?>