jQuery(document).ready(function ($) {
  // Cambiar la imagen principal al hacer clic en una miniatura
  $('.mybooking-cpt-gallert_carousel-thumbnail').on('click', function () {
    console.log('Miniatura clickeada'); // Verifica que el evento se ejecuta
    var fullSizeImage = $(this).attr('data-full-size'); // Obtener la URL de la imagen completa
      console.log('URL de la imagen completa:', fullSizeImage); // Verifica la URL
    $('.mybooking-cpt-gallery-main-image img').attr('src', fullSizeImage); // Cambiar la imagen principal
  });

  // Scroll suave al hacer clic en una miniatura
  const thumbnails = document.querySelectorAll('.mybooking-cpt-gallery_carousel-thumbnail');
  const carouselContainer = document.querySelector('.mybooking-cpt-gallery_carousel');

  thumbnails.forEach((thumbnail) => {
    thumbnail.addEventListener('click', function () {
      const targetOffset = thumbnail.offsetLeft; // Posición de la miniatura clickeada
      const containerWidth = carouselContainer.offsetWidth; // Ancho del contenedor
      const thumbnailWidth = thumbnail.offsetWidth; // Ancho de la miniatura

      // Calculamos la posición para centrar la miniatura
      const scrollPosition = targetOffset - (containerWidth / 2) + (thumbnailWidth / 2);

      // Hacemos scroll suave
      carouselContainer.scrollTo({
        left: scrollPosition,
        behavior: 'smooth',
      });
    });
  });
});