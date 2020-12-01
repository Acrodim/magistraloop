<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
        <h4>Удалить участок #<?php echo $id; ?></h4>


        <p>Вы действительно хотите удалить этот участок?</p>

        <form method="post">
            <input type="submit" name="submit" value="Удалить" />
        </form>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>