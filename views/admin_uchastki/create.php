<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">

  <?php if (isset($errors) && is_array($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li> - <?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <h4 class="text-center">Добавление участка</h4>

  <form method="POST" class="add-uchastok border border-secondary">
        
    <div class="form-row">
      <div class="form-group col-md-1">
        <label for="uchastok_id">№ уч.</label>
        <input type="text" name="uchastok_id" class="form-control" id="uchastok_id">
      </div>

      <div class="form-group col-md-9">
        <label for="user_id">Садовод</label>
        <select name="user_id" class="form-control" id="user_id">
          <option></option>

          <?php foreach($users as $user):?>
            
            <option value="<?=$user['id']?>"><?=$user['sadovod']?></option>
          
          <?php endforeach;?>
        </select>
      </div>

      <div class="form-group col-md-2">
        <label for="button">Новый садовод</label>
        <button type="button" class="btn btn-secondary" id="button"><a href="/admin/sadovod/create">Добавить садовода</a></button>
      </div>

    </div>
   
    <div class="form-row">
       <div class="form-group col-md-1">
        <label for="square">Площадь</label>
        <input name="square" class="form-control" id="square">
      </div>

       <div class="form-group col-md-10">
        <label for="comment">Комментарий</label>
        <input type="text" name="comment" class="form-control" id="comment">
      </div>
    </div>

    <div class="form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="hidden" name="private" value='Нет'>
        <input class="form-check-input" type="checkbox" name="private" value='Да'> Приватизирован
      </label>
    </div>

  	<button type="submit" name="add" class="btn btn-secondary btn-lg btn-block">Добавить</button>

  </form>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>