document.addEventListener('DOMContentLoaded', function () {
    var links = document.querySelectorAll('.footer_link');
    links.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var content = link.getAttribute('data-content');
            fetchModalContent(content);
        });
    });
});

function fetchModalContent(content) {
  fetch('client/components/modal-footer.php?content=' + content)
        .then(response => response.text())
        .then(data => {
            var modalContent = document.querySelector('#dynamicModal .modal-content');
            modalContent.innerHTML = data;
            var myModal = new bootstrap.Modal(document.getElementById('dynamicModal'));
            myModal.show();
        })
        .catch(error => console.error('Error al cargar el modal:', error));
}