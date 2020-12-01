<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
        <h4>Удалить показания участка #<?= $electro['uchastok_id']; ?> от <?= $electro['date_electro']; ?></h4>


        <p>Вы действительно хотите удалить эти показания?</p>

        <form method="post">
            <input type="submit" name="submit" value="Удалить" />
        </form>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>