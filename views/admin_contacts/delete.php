<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
        <h4>Удалить контакт <span><?= $contact['column_1'] . ' ' . $contact['column_2']; ?></span></h4>


        <p>Вы действительно хотите удалить этот контакт?</p>

        <form method="post">
            <input type="submit" name="submit" value="Удалить" />
        </form>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>