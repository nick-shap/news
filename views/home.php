<?php include_once 'includes/header.php'

/** @var array $news */
?>

<div>
    <h1 class="title mt-4 mb-4">Новости</h1>

    <a class="btn btn-success" href="/news/create">Добавить</a>

    <div class="list-group mt-4">
        <?php foreach ($news as $item): ?>
            <div class="mb-3">
                <div class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?= $item['name'] ?></h5>
                        <form action="/news/destroy"  method="post">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button type="submit" class="btn btn-danger">X</button>
                        </form>
                    </div>
                    <p class="mb-1"><?= $item['preview'] ?></p>
                    <div class="mt-3 mb-1">
                        <a href="/news/show?id=<?= $item['id'] ?>" class="btn btn-primary">Читать</a>
                        <a href="/news/edit?id=<?= $item['id'] ?>" class="btn btn-secondary">Редактировать</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <nav class="mt-4">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active">
                <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
        </ul>
    </nav>
</div>
<?php include_once 'includes/footer.php'?>