<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
	<h2 class="text-center">Контакты</h2>

	<?php if ($userRole == 'admin'): ?>
		<button type="button" class="btn btn-secondary"><a href="/admin/contact/create">Добавить новый контакт</a></button>
	<?php endif; ?>
	<table class="table table-bordered">
	   <thead>
	    <tr>
	      <th scope="col" style="width: 30%"></th>
	      <th scope="col" style="width: 30%"></th>
	      <th scope="col" style="width: 20%"></th>

	      <?php if ($userRole == 'admin'): ?>
	      	<th scope="col" colspan="2" style="width: 10%"></th>
	      <?php endif; ?>

	    </tr>
	  </thead>

	  <tbody>
	  	<?php foreach ($contacts as $contact): ?>
		    <tr>
		      <td><?= $contact['column_1'] ?></td>
		      <td><?= $contact['column_2'] ?></td>
		      <td><a href="tel:<?= $contact['column_3'] ?>"><?= $contact['column_3'] ?></a></td>
		      <?php if ($userRole == 'admin'): ?>
			      <td><a href="/admin/contact/update/<?=$contact['id']?>">Изм.</a></td>
	          	  <td><a href="/admin/contact/delete/<?=$contact['id']?>">Уд.</a></td>
	          <?php endif; ?>
		    </tr>
		<?php endforeach ?>
	  </tbody>
	</table>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>