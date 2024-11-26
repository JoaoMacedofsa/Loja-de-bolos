<?php
// Inclui as funções
require 'admin/functions.php';

// Conecta ao banco de dados
$connB = conectarBanco();

// Busca os bolos
$bolos = buscarBolos($connB);
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gâteaux Bolos</title>
  <!-- Link do Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style-home.css">
</head>
<body>
     <!-- Barra de Navegação -->
  <nav class="navbar navbar-expand-lg py-3" style="background-color: #F5E5C0;">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="img\logo3.webp" width="50" height="50" class="me-2">
      </a>

      <!-- Links centralizados -->
      <div class="mx-auto">
        <ul class="navbar-nav">
          <li class="nav-item d-inline">
            <a class="nav-link text-dark fw-bold" href="#">Gâteaux</a>
          </li>
          <li class="nav-item d-inline">
            <a class="nav-link text-dark fw-bold" href="#">|</a>
          </li>
          <li class="nav-item d-inline">
            <a class="nav-link text-dark fw-bold" href="#">Bolos</a>
          </li>
          <li class="nav-item d-inline">
            <a class="nav-link text-dark fw-bold" href="#">|</a>
          </li>
          <li class="nav-item d-inline">
            <a class="nav-link text-dark fw-bold" href="#">Lojas</a>
          </li>
          <li class="nav-item d-inline">
            <a class="nav-link text-dark fw-bold" href="#">|</a>
          </li>
          <li class="nav-item d-inline">
            <a class="nav-link text-dark fw-bold" href="#">Contato</a>
          </li>
        </ul>
      </div>

      <!-- Botões alinhados à direita -->
      <div class="d-flex">
        <a href="#" class="btn me-2" style="background-color: #5A4033; color: white;">Peça no app</a>
        <a href="#" class="btn" style="background-color: #5A4033; color: white;">Seja um franqueado</a>
      </div>
    </div>
  </nav>

    <!-- Carrossel de Imagens -->
  <div id="carouselBolos" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/banner.png" class="d-block w-100" alt="Bolo de Chocolate">
        </div>
        <div class="carousel-item">
          <img src="img/banner2.jpg" class="d-block w-100" alt="Bolo de Morango">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselBolos" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselBolos" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Próximo</span>
      </button>
  </div>
  
<!-- Conteúdo principal -->
<div class="container my-4">
  <h1 class="text-center mb-1">Menu</h1>
  <h4 class="text-center mb-4">Sabor para todos os gostos</h4>

  <div id="menuCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
      <?php
        $bolosPorSlide = 4; // Número de bolos por slide
        $contador = 0; // Contador para os bolos
        $slideAtivo = true; // Primeiro slide ativo

        if ($bolos->num_rows > 0) { 
          while ($row = $bolos->fetch_assoc()) {
              if ($contador % $bolosPorSlide == 0) {
                  if ($contador > 0) echo '</div></div>'; 
                  echo '<div class="carousel-item ' . ($slideAtivo ? 'active' : '') . '"><div class="row g-4">';
                  $slideAtivo = false; 
              }
      
              // Depuração
              echo '<!-- Caminho da imagem: ' . $row['imagem_url'] . ' -->';
      
              echo '
                  <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                      <div class="card">
                          <img src="' . $row['imagem_url'] . '" class="cake-card" alt="' . htmlspecialchars($row['nome_bolo']) . '">
                          <div class="card-body text-center">
                              <h5 class="card-title">' . htmlspecialchars($row['nome_bolo']) . '</h5>
                              <button class="btn buy-button">R$ ' . number_format($row['preco'], 2, ',', '.') . '</button>
                          </div>
                      </div>
                  </div>
              ';
      
              $contador++;
          }
          echo '</div></div>';
      } else {
          echo '<div class="carousel-item active">
                  <div class="text-center">
                      <h5>Nenhum bolo disponível no momento.</h5>
                  </div>
                </div>';
      }
      
      ?>
      </div>
    <!-- Controles do carrossel -->
    <button class="carousel-control-prev" type="button" data-bs-target="#menuCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#menuCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Próximo</span>
    </button>
  </div>



  <!-- Link do Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">

</script><?php include "includes/footer.php";?>
</body>

</html>
