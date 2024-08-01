<?php include_once 'includes/header.php'?>

<div>
    <div class="mb-4">
        <h1 class="title">Добавить новость</h1>
    </div>

    <div class="form">
        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">Название: </label>
                <label>
                    <input type="text" name="name" class="form-control">
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label">Превью: </label>
                <label>
                    <textarea name="preview" class="form-control" cols="30" rows="5"></textarea>
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label">Детально: </label>
                <label>
                    <textarea name="detail" class="form-control" cols="30" rows="5"></textarea>
                </label>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Создать</button>
            </div>
        </form>
    </div>
</div>
<?php include_once 'includes/footer.php'?>