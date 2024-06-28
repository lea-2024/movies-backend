<?php
// Obtener el parámetro 'content' de la URL
$content = isset($_GET['content']) ? $_GET['content'] : 'default';

// Definir el contenido del modal según el parámetro
switch ($content) {
    case 'terms':
        $modalTitle = 'Términos y Condiciones';
        $modalBody = 'Estos son los términos y condiciones de uso de nuestra página web. Al usar este sitio, aceptas cumplir con todos los términos aquí descritos.';
        break;
    case 'pregunt':
        $modalTitle = 'Preguntas frecuentes';
        $modalBody = 'Esta es Preguntas frecuentes.';
        break;
    case 'ayuda':
        $modalTitle = 'Ayuda';
        $modalBody = 'Esta es la ayuda.';
        break;
    default:
        $modalTitle = 'Contacto';
        $modalBody = 'Mail de contacto.';
        break;
}
?>
<section class="modal-container">
    <div class="modal-header">
        <h5 class="modal-title" id="dynamicModalLabel"><?php echo $modalTitle; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <?php echo $modalBody; ?>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    </div>
</section>