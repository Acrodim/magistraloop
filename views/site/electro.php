<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
	<h4 class="text-center">Показания электросчётчиков</h4>

	<?php if ($userRole == 'admin'): ?>
		<button type="button" class="btn btn-secondary"><a href="/admin/electro/create">Добавить показания</a></button>
	<?php endif; ?>	

	<table class="table table-bordered">
	  <thead>
	    <tr>
	      <th scope="col" style="width: 5%">№</th>
	      <th scope="col" style="width: 15%">Показания</th>
	      <th scope="col" style="width: 15%">Дата</th>
	      <th scope="col" style="width: 5%">Контроллёр</th>
	      <th scope="col" style="width: 35%">Комментарий</th>
	       <?php if ($userRole == 'admin'): ?>
	         <th scope="col" colspan="2" class="text-center" style="width: 10%">Действие</th>
	       <?php endif; ?>
	    </tr>
	  </thead>
	  <tbody>
	    
	      <?php foreach ($electroAll as $electro): ?>
	        <tr>
	          <td><a href="/admin/uchastok/<?=$electro['uchastok_id']?>"><?=$electro['uchastok_id']?></a></td>
	          <td><?=$electro['counter']?></a></td>
	          <td><?=$electro['date_electro']?></td>
	          <td><?=$electro['controller']?></td>
	          <td><?=$electro['comment']?></td>
	          <?php if ($userRole == 'admin'): ?>
              	<td><a href="">Изм.</a></td>
              	<td><a href="admin/electro/delete/<?=$electro['id']?>">Уд.</a></td>
              <?php endif; ?>
	        </tr>
	      <?php endforeach ?>
	    
	  </tbody>
	</table>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>