<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
  <p>Садовод: <a href="/admin/sadovod/update/<?= $user['id'] ?>"><?= $user['surname'] . " " . $user['name']?></a></p>
  <p>Телефон: <a href="tel:<?=$user['phone']?>"><?=$user['phone']?></a></p>
  <p>Адрес: <?=$user['address']?></p>
  <h4 class="text-center">Список участков садовода</h4>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col" style="width: 5%">№</th>
        <th scope="col" style="width: 5%">Площадь</th>
        <th scope="col" style="width: 5%">Приватиз.</th>
        <th scope="col" style="width: 35%">Комментарий</th>
        <th scope="col" colspan="2" class="text-center" style="width: 10%">Действие</th>
      </tr>
    </thead>
    <tbody>
      
        <?php foreach ($uchastkiBySadovod as $uchastok): ?>
          <tr>
            <td><a href="/admin/uchastok/<?= $uchastok['uchastok_id'] ?>"><?=$uchastok['uchastok_id']?></a></td>
            <td><?=$uchastok['square']?></td>
            <td><?=$uchastok['private']?></td>
            <td><?=$uchastok['comment']?></td>
            <td><a href="/admin/uchastok/update/<?= $uchastok['uchastok_id'] ?>">Изм.</a></td>
            <td><a href="/admin/uchastok/delete/<?=$uchastok['uchastok_id']?>">Уд.</a></td>
          </tr>
        <?php endforeach ?>
      
    </tbody>
  </table>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>