<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
	<h4 class="text-center">Редактирование садовода</h4>

	<form method="POST" class="add-user border border-secondary">    
	  <div class="form-row">
	    <div class="form-group col-md-5">
	      <label for="surname">Фамилия</label>
	      <input type="hidden" name="id" class="form-control" id="id" value="<?= $user['id'] ?>">
	      <input type="text" name="surname" class="form-control" id="surname" value="<?= $user['surname'] ?>" required>
	    </div>
	    <div class="form-group col-md-7">
	      <label for="name">Имя</label>
	      <input type="text" name="name" class="form-control" id="name" value="<?= $user['name'] ?>" required>
	      </select>
	    </div>
	  </div>
	 
	  <div class="form-row">
	     <div class="form-group col-md-5">
	      <label for="phone">Телефон</label>
	      <input name="phone" class="form-control" id="phone" value="<?= $user['phone'] ?>">
	    </div>
	    <div class="form-group col-md-7">
	      <label for="address">Адрес</label>
	      <input name="address" class="form-control" id="address" value="<?= $user['address'] ?>">
	    </div>
	     <div class="form-group col-md-12">
	      <label for="comment">Комментарий</label>
	      <input type="text" name="comment" class="form-control" id="inputZip" value="<?= $user['comment'] ?>">
	    </div>
	  </div>

	  <button type="submit" name="update" class="btn btn-secondary btn-lg btn-block">Сохранить</button>
	</form>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>