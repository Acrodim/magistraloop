<?php include ROOT . '/views/layouts/header.php'; ?>

  <div class="container">
    
      <div class="grid-posts">
        <div class="container">
          <div class="row d-flex justify-content-around">
          
            <div class="card border" style="width: 18rem;">
              <div class="card-body">
                <a href="/buses" class="btn btn-primary stretched-link">Маршрутки</a>
              </div>
            </div>

            <div class="card border" style="width: 18rem;">
              <div class="card-body">
                <a href="/poliv" class="btn btn-primary stretched-link">Полив</a>
              </div>
            </div>

            <div class="card border" style="width: 18rem;">
              <div class="card-body">
                <a href="/tarif" class="btn btn-primary stretched-link">Тарифы</a>
              </div>
            </div>

            <div class="card border" style="width: 18rem;">
              <div class="card-body">
                <a href="/grafik" class="btn btn-primary stretched-link">График конторы</a>
              </div>
            </div>

            <?php if ($userRole == 'admin' || $userRole == 'pravlenie'): ?>
              <div class="card border" style="width: 18rem;">
                <div class="card-body">
                  <a href="/uchastki" class="btn btn-primary stretched-link">Участки</a>
                </div>
              </div>

               <div class="card border" style="width: 18rem;">
                <div class="card-body">
                  <a href="/sadovods" class="btn btn-primary stretched-link">Садоводы</a>
                </div>
              </div>

              <div class="card border" style="width: 18rem;">
                <div class="card-body">
                  <a href="/electro" class="btn btn-primary stretched-link">Показания счётчиков</a>
                </div>
              </div>
            <?php endif; ?>

            <div class="card border" style="width: 18rem;">
              <div class="card-body">
                <a href="/contacts" class="btn btn-primary stretched-link">Контакты</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    
  </div>

<?php include ROOT . '/views/layouts/footer.php'; ?>