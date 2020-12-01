<?php include ROOT . '/views/layouts/header.php'; ?>
	<div class="container">

		<h4 class="text-center">Список садоводов, живущих в СВТ</h4>

		<?php if ($userRole == 'admin'): ?>
			<button type="button" class="btn btn-secondary"><a href="/admin/sadovod/create">Добавить нового садовода</a></button>
		<?php endif; ?>	

	    <table class="table table-bordered">
	      <thead>
	        <tr>
	          <th scope="col" style="width: 35%">ФИО</th>
	          <th scope="col" style="width: 10%">Телефон</th>
	          <th scope="col" style="width: 15%">Адрес</th>
	          <th scope="col" style="width: 20%">Комментарий</th>

	       	  <?php if ($userRole == 'admin'): ?>
		         <th scope="col" colspan="2" class="text-center" style="width: 10%">Действие</th>
		      <?php endif; ?>

	        </tr>
	      </thead>
	      <tbody>
	        
	          <?php foreach ($usersSvt as $user): ?>
	            <tr>
	              <td><a href="/admin/sadovod/<?=$user['id']?>"><?=$user['sadovod']?></td>
	              <td><a href="tel:<?=$user['phone']?>"><?=$user['phone']?></a></td>
	              <td><?=$user['address']?></td>
	              <td><?=$user['comment']?></td>

	              <?php if ($userRole == 'admin'): ?>
	              	<td><a href="admin/sadovod/update/<?=$user['id']?>">Изм.</a></td>
	              	<td><a href="admin/sadovod/delete/<?=$user['id']?>">Уд.</a></td>
	              <?php endif; ?>

	            </tr>
	          <?php endforeach ?>
	        
	      </tbody>
	    </table>
	</div>
<?php include ROOT . '/views/layouts/footer.php'; ?>