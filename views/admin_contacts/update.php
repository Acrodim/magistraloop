<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
	<h4 class="text-center">Редактирование контакта</h4>

	<form method="POST" class="add-user border border-secondary">    
	  <div class="form-row">
	    <div class="form-group col-md-5">
	      <label for="column_1">Колонка 1</label>
	      <input type="hidden" name="id" class="form-control" id="id" value="<?= $contact['id'] ?>">
	      <input type="text" name="column_1" class="form-control" id="column_1" value="<?= $contact['column_1'] ?>" required>
	    </div>

	    <div class="form-group col-md-7">
	      <label for="column_2">Колонка 2</label>
	      <input type="text" name="column_2" class="form-control" id="column_2" value="<?= $contact['column_2'] ?>">
	    </div>
	  </div>

	   <div class="form-row">
	    <div class="form-group col-md-5">
	      <label for="column_3">Колонка 3</label>
	      <input type="hidden" name="id" class="form-control" id="id">
	      <input type="text" name="column_3" class="form-control" id="column_3" value="<?= $contact['column_3'] ?>" required>
	    </div>

	    <div class="form-group col-md-7">
	      <label for="contact_order">Порядок</label>
	      <input type="text" name="contact_order" class="form-control" id="contact_order" value="<?= $contact['contact_order'] ?>" required>
	    </div>
	  </div>

	  <button type="submit" name="update" class="btn btn-secondary btn-lg btn-block">Сохранить</button>
	</form>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>