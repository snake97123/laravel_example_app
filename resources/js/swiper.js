document.addEventListener('DOMContentLoaded', function() {
  var swipers = document.querySelectorAll('.swiper-container');
  swipers.forEach(function(swiperContainer) {
    new Swiper(swiperContainer, {
      loop: true,
      pagination: {
        el: swiperContainer.querySelector('.swiper-pagination'),
        clickable: true,
        type: 'bullets',
      },
    });
  });
});