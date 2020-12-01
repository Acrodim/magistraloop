<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
        <h4>Удалить садовода <span><a href=""><?= $user['surname'] . " " . $user['name'] ?></a></span></h4>


        <p>Вы действительно хотите удалить этого садовода?</p>

        <form method="post">
            <input type="submit" name="submit" value="Удалить" />
        </form>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>