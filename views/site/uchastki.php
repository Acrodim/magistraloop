<?php include ROOT . '/views/layouts/header.php'; ?>
<div class="container">

  <h4 class="text-center">Статистика по участкам</h4>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th class="text-center" scope="col" style="width: 40%">Участки</th>
        <th class="text-center" scope="col" style="width: 20%">Кол-во</th>
        <th class="text-center" scope="col" style="width: 40%">Площадь</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>Приватизированные</td>
        <td class="text-right"><?=$uchastkiPrivat['count']?></td>
        <td class="text-right"><?=$uchastkiPrivat['total_square']?></td>
      </tr>
    </tbody>

     <tbody>
      <tr>
        <td>Неприватизированные</td>
        <td class="text-right"><?=$uchastkiNotPrivat['count']?></td>
        <td class="text-right"><?=$uchastkiNotPrivat['total_square']?></td>
      </tr>
    </tbody>

     <tbody>
      <tr>
        <td>Всего</td>
        <td class="text-right"><?=$uchastkiCount['count']?></td>
        <td class="text-right"><?=$uchastkiCount['total_square']?></td>
      </tr>
    </tbody>
  </table>

  <h4 class="text-center">Список участков</h4>
  <?php if ($userRole == 'admin'): ?>
    <button type="button" class="btn btn-secondary"><a href="/admin/uchastok/create">Добавить новый участок</a></button>
  <?php endif; ?>  

  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col" style="width: 5%">№</th>
        <th scope="col" style="width: 40%">Садовод</th>
        <th scope="col" style="width: 5%">Площадь</th>
        <th scope="col" style="width: 5%">Приватиз.</th>
        <th scope="col" style="width: 35%">Комментарий</th>

        <?php if ($userRole == 'admin'): ?>
          <th scope="col" colspan="2" class="text-center" style="width: 10%">Действие</th>
        <?php endif; ?>

      </tr>
    </thead>
    <tbody>
      
        <?php foreach ($uchastki as $uchastok): ?>
          <tr>
            <td><a href="/admin/uchastok/<?=$uchastok['uchastok_id']?>"><?=$uchastok['uchastok_id']?></a></td>
            <td><a href="/admin/sadovod/<?=$uchastok['user_id']?>"><?=$uchastok['sadovod']?></a></td>
            <td><?=$uchastok['square']?></td>
            <td><?=$uchastok['private']?></td>
            <td><?=$uchastok['comment']?></td>

            <?php if ($userRole == 'admin'): ?>
              <td><a href="/admin/uchastok/update/<?=$uchastok['uchastok_id']?>">Изм.</a></td>
              <td><a href="/admin/uchastok/delete/<?=$uchastok['uchastok_id']?>">Уд.</a></td>
            <?php endif; ?>  

          </tr>
        <?php endforeach ?>
      
    </tbody>
  </table>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>