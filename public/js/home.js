$(function () {
  var url = window.location.href.split('/');
  var page = url[url.length-1];
  var body = $('body');

  body.on('mouseenter', '#nav-sectors-link', function () {
    if (page != 'sectors') {
      $('.task-page').hide();
      $('.sectors-page').show();
      $('.sections-page').hide();
      $('.clients-page').hide();
      $('.users-page').hide();
      $('.info-page').hide();
    }else{
      $('.global-section').hide();
      $('.task-page').show();
    }
  });

  body.on('mouseenter', '#nav-sections-link', function () {
    if (page != 'sections') {
      $('.task-page').hide();
      $('.sectors-page').hide();
      $('.sections-page').show();
      $('.clients-page').hide();
      $('.users-page').hide();
      $('.info-page').hide();
    }else{
      $('.global-section').hide();
      $('.task-page').show();
    }
  });

  body.on('mouseenter', '#nav-clients-link', function () {
    if (page != 'clients') {
      $('.task-page').hide();
      $('.sectors-page').hide();
      $('.sections-page').hide();
      $('.clients-page').show();
      $('.users-page').hide();
      $('.info-page').hide();
    }else{
      $('.global-section').hide();
      $('.task-page').show();
    }
  });

  body.on('mouseenter', '#nav-users-link', function () {
    if (page != 'users') {
      $('.task-page').hide();
      $('.sectors-page').hide();
      $('.sections-page').hide();
      $('.clients-page').hide();
      $('.users-page').show();
      $('.info-page').hide();
    }else{
      $('.global-section').hide();
      $('.task-page').show();
    }
  });

  body.on('mouseenter', '#nav-info-link', function () {
    if (page != 'info') {
      $('.task-page').hide();
      $('.sectors-page').hide();
      $('.sections-page').hide();
      $('.clients-page').hide();
      $('.users-page').hide();
      $('.info-page').show();
    }else{
      $('.global-section').hide();
      $('.task-page').show();
    }
  });

  $(document).on('click', 'a[href="#"]', function (e) {
    e.preventDefault();
  });

  //Open menu func
  $(document).on('click', '.js-open-menu-link', function () {
    var ths = $(this),
      wrap = ths.closest('.js-open-menu-wrapper');

    wrap.toggleClass('global-wrapper-open');
    if(page == '' && wrap.hasClass('global-wrapper-open')){
      $('.task-page').hide();
    }else{
      $('.task-page').show()
    }
  });

  //Nav func
  $(document).on('click', '.js-nav-link', function () {
    var ths = $(this),
      dataSection = ths.attr('data-section'),
      wrap = ths.closest('.js-open-menu-wrapper');

    wrap.find('.current-section').removeClass('current-section');
    wrap.find('.js-nav-section[data-section=' + dataSection + ']').addClass('current-section');
    ths.addClass('current-section');
    wrap.addClass('global-wrapper-page');

    $('.js-open-menu-link').click();

    if (dataSection === 'task-section') {
      wrap.addClass('global-wrapper-task-page');
    } else {
      wrap.removeClass('global-wrapper-task-page');
    }

  });
});