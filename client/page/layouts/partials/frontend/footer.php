<?php 
  $uri_actual = $_SERVER['REQUEST_URI'];
?>
<!-- Fin contenido principal -->
  <!-- Contenedor del modal footer-->
  <div class="modal fade" id="dynamicModal" tabindex="-1" aria-labelledby="dynamicModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- El contenido del modal se cargará aquí -->
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="termsModalLabel">Términos y Condiciones</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>
            Estos son los términos y condiciones de uso de nuestra página web. Al usar este sitio, aceptas cumplir con
            todos los términos aquí descritos.
          </p>
          <p>
            1. Uso del sitio: ...
          </p>
          <p>
            2. Propiedad intelectual: ...
          </p>
          <!-- Agrega más contenido según sea necesario -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!-- Footer - Links de navegación - Botón ir a top -->
  <footer class="container-fluid">
    <!-- links de navagación - footer -->
    <div class="container-fluid py-5 text-center position-relative">
      <div class="row mb-2 mb-md-0">
        <div class="col-12">
          <nav class="footer_links d-flex justify-content-center">
            <ul
              class="footer_list_links d-flex row-gap-3 w-100 flex-md-row flex-column justify-content-md-evenly align-items-center p-0">
              <li class="footer_item">
                <a href="#" class="footer_link" data-content="terms" data-url="<?php echo $uri_actual === '/index.php' ? '/' : '' ?>">Términos y condiciones</a>
              </li>
              <li class="footer_item">
                <a href="#" class="footer_link" data-content="pregunt" data-url="<?php echo $uri_actual === '/index.php' ? '/' : '' ?>">Preguntas frecuentes</a>
              </li>
              <li class="footer_item">
                <a href="#" class="footer_link" data-content="ayuda" data-url="<?php echo $uri_actual === '/index.php' ? '/' : '' ?>">Ayuda</a>
              </li>
              <li class="footer_item">
                <a href="#" class="footer_link" data-content="default" data-url="<?php echo $uri_actual === '/index.php' ? '/' : '' ?>">Contacto</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>

      <!-- CopyRight -->
      <div class="row w-100 text-center bottom-0 position-absolute">
        <div class="col">
          <p class="footer_copyRight">&copy; CAC - PHP-ERROR 404 - 2024</p>
        </div>
      </div>
    </div>

    <!-- Botón ir arriba-->
    <a class="btn_top" id="btnTop">
      <img src="<?php echo $uri_actual === '/index.php' ? './client/asset/images/flecha-hacia-arriba.svg' : '../asset/images/flecha-hacia-arriba.svg' ?>" alt="Ir arriba flecha" class="btn_top_image" />
    </a>
  </footer>
  <!-- Fin footer-->
  <!-- Enlace script index.js-->
  <script src="<?php echo $uri_actual === '/index.php' ? './client/asset/js/index.js' : '../asset/js/index.js' ?>"></script>
  <script src="<?php echo $uri_actual === '/index.php' ? './client/asset/js/search.js' :'../asset/js/search.js' ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
  <!-- Script para el modal del footer-->
  <script src="<?php echo $uri_actual === '/index.php' ? './client/asset/js/modal_footer.js' :'../asset/js/modal_footer.js' ?>"></script>
  <script>
  // JavaScript para mostrar el div si hay resultados y el botón de limpiar
  <?php if (isset($resultados) && !empty($resultados)): ?>
  document.getElementById('resultados').style.display = 'block';
  document.getElementById('clearButton').style.display = 'inline-block';
  window.location.hash = 'searchAncla';
  <?php endif;?>
  </script>
</body>

</html>