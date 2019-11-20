<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarCollapse">
  <ul class="navbar-nav mr-auto">
      <?php 
          if (isset($_SESSION['loggedin'])) {
              echo "<li class='nav-item'><a class='nav-link' href='". BASEURL ."/fornecedores.php'>Fornecedores</a></li>";
              echo "<li class='nav-item'><a class='nav-link' href='". BASEURL ."/produtos.php'>Produtos</a></li>";
          }
      ?>
  </ul>

  <div class="col-4 d-flex justify-content-end align-items-center">
      <?php 
          if (isset($_SESSION['loggedin'])) {
              echo "<span class='logged_user'><i class='fa fa-user-circle fa-2x'></i>". $_SESSION['name'] ."</span> <a class='btn btn-sm btn-outline-primary' href='". BASEURL ."/logout.php'> <i class='fa fa-sign-out'></i> Sair</a>";
          }
      ?>
 </div>
</div>
