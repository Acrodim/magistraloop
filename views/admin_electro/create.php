<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
	<h4 class="text-center">Показания электросчётчиков</h4>

	<form method="POST" class="add-uchastok border border-secondary">
	      
	  <div class="form-row">
	    <div class="form-group col-md-1">
	      <input type="hidden" name="controller" class="form-control" id="controller" value="<?=$_SESSION['userName']?>">
	      <label for="uchastok_id">№ уч.</label>
	      <select name="uchastok_id" class="form-control" id="uchastok_id" required>
	        <option></option>
	        <?php foreach ($uchastki as $uchastok): ?>
	          <option value="<?= $uchastok['uchastok_id'] ?>"><?= $uchastok['uchastok_id'] ?></option>
	        <?php endforeach ?>
	      </select>
	    </div>
	    
	    <div class="form-group col-md-2">
	      <label for="counter">Показания</label>
	      <input name="counter" class="form-control" id="counter" required>
	    </div>
	  
	    <div class="form-group col-md-9">
	      <label for="comment">Комментарий</label>
	      <input type="text" name="comment" class="form-control" id="comment">
	    </div>
	  
	  </div>

	  <button type="submit" name="add" class="btn btn-secondary btn-lg btn-block">Сохранить</button>
	</form>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>