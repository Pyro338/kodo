$(document).ready(function () {
  $('#check-transliteration-button').click(function () {
    let cyr_string = $('#cyr-text').val().trim();
    let lat_string = $('#lat-text').val().trim();
    checkTranslate(cyr_string, lat_string);
  });

  $('#sign-button').click(function () {
    let sign_name = $('#sign-name').val().trim();
    let sign_email = $('#sign-email').val().trim();
    sendSignEmail(sign_name, sign_email);
  });

  $('#cardnumber-button').click(function () {
    let cardnumber = $('#cardnumber').val().trim();
    checkCardNumber(cardnumber);
  });

  $('#ter-button').click(function () {
    let ter_surname = $('#ter-surname').val().trim();
    let ter_name = $('#ter-name').val().trim();
    let ter_thirdname = $('#ter-thirdname').val().trim();
    checkTerrorist(ter_surname, ter_name, ter_thirdname);
  });

  $('#ur-person-button').click(function () {
    let ur_surname = $('#ur-surname').val().trim();
    let ur_name = $('#ur-name').val().trim();
    let ur_thirdname = $('#ur-thirdname').val().trim();
    let ur_inn = del_spaces($('#ur-inn').val().trim());
    underwritingPerson(ur_surname, ur_name, ur_thirdname, ur_inn);
  });

  $('#ur-company-button').click(function () {
    let ur_company = $('#ur-company-name').val().trim();
    let ur_ogrn = del_spaces($('#ur-company-ogrn').val().trim());
    let ur_inn = del_spaces($('#ur-company-inn').val().trim());
    let ur_kpp = del_spaces($('#ur-company-kpp').val().trim());
    if (!isNaN(ur_ogrn) || ur_ogrn == '') {
      underwritingCompany(ur_company, ur_ogrn, ur_inn, ur_kpp);
    }
  });

  $('#fssp-person-button').click(function () {
    let fssp_surname = $('#fssp-surname').val().trim();
    let fssp_name = $('#fssp-name').val().trim();
    let fssp_thirdname = $('#fssp-thirdname').val().trim();
    let fssp_region = $('#fssp-region').val();
    let fssp_birthdate = $('#fssp-birthdate').val()
    fsspPerson(fssp_region, fssp_name, fssp_thirdname, fssp_surname, fssp_birthdate);
  });

  $('#emp-company-button').click(function () {
    let okopf = $('#emp-okopf').val();
    let organisation = $('#emp-company-name').val();
    let inn = $('#emp-company-inn').val();
    getCompany(organisation, okopf, inn);
  });

  $('#emp-okopf').change(function () {
    $('#emp-company-name-label').show(200);
    $('#emp-company-name').show(300);
  });

  $('.fa-university').click(function () {
    $('.client-fields').hide(300);
    $('.bank-fields').show(300);
  });

  $('.fa-user').click(function () {
    $('.bank-fields').hide(300);
    $('.client-fields').show(300);
  });

  $('#emp2-type').change(function () {
    switch ($('#emp2-type').val()) {
      case '0':
        $('.emp2-ip-block').hide(300);
        $('.emp2-org-block').hide(300);
        break;
      case '1':
        $('.emp2-ip-block').hide(300);
        $('.emp2-org-block').show(300);
        break;
      case '2':
        $('.emp2-ip-block').show(300);
        $('.emp2-org-block').hide(300);
        break;
    }
  });

  $('#emp-2-add-params').change(function () {
    switch ($('#emp-2-add-params').val()) {
      case '0':
        $('#emp2-company-ogrn').hide();
        $('#emp2-company-inn').hide();
        $('#emp2-company-kpp').hide();
        break;
      case '1':
        $('#emp2-company-ogrn').show();
        $('#emp2-company-inn').hide();
        $('#emp2-company-kpp').hide();
        break;
      case '2':
        $('#emp2-company-ogrn').hide();
        $('#emp2-company-inn').show();
        $('#emp2-company-kpp').hide();
        break;
      case '3':
        $('#emp2-company-ogrn').hide();
        $('#emp2-company-inn').hide();
        $('#emp2-company-kpp').show();
        break;
    }
  });

  $('body').on('click', '#emp2-person-button', function () {
    let surname = $('#emp2-surname').val().trim();
    let name = $('#emp2-name').val().trim();
    let thirdname = $('#emp2-thirdname').val().trim();
    let inn = del_spaces($('#emp2-inn').val().trim());
    emp2_findPerson(surname, name, thirdname, inn);
  });

  $('body').on('click', '#emp2-company-button', function () {
    let company = $('#emp2-company-name').val().trim();
    let ogrn = del_spaces($('#emp2-company-ogrn').val().trim());
    let inn = del_spaces($('#emp2-company-inn').val().trim());
    let kpp = del_spaces($('#emp2-company-kpp').val().trim());
    if (!isNaN(ogrn) || ogrn == '') {
      emp2_findCompany(company, ogrn, inn, kpp);
    }
  });

  $('body').on('click', '.person-block .readmore', function () {
    let person_id = $(this).attr('data-personid');
    personReadMore(person_id);
  });

  $('body').on('click', '.company-block .readmore', function () {
    let company_id = $(this).attr('data-companyid');
    companyReadMore(company_id);
  });

  $('body').on('click', '.company-block .readmore-financical', function () {
    let company_id = $(this).attr('data-companyid');
    companyFinancical(company_id);
  });

  $('body').on('click', '#fssp-person-check-status-button', function () {
    let fssp_task = $('#fssp-person-task').val();
    fsspPersonStatus(fssp_task);
  });

  $('body').on('click', '#fssp-person-result-button', function () {
    let fssp_task = $('#fssp-person-task').val();
    fsspPersonResult(fssp_task);
  });

  $('body').on("change", ".fact-address-checkbox", function () {
    $('.fact-address').toggle();
  });
});

function findPersonAjax(surname, firstname, middlename, inn, data) {
  $('.loading').show();
  ajaxSetup();
  $.ajax({
    url     : "/underwritingPersonAjax/",
    dataType: "json",
    data    : {
      surname   : surname,
      firstname : firstname,
      middlename: middlename,
      inn       : inn
    },
    success : data,
    error   : 'error'
  });
}

function emp2FindPersonAjax(surname, firstname, middlename, inn, data) {
  $('.loading').show();
  ajaxSetup();
  $.ajax({
    url     : "/emp2FindPersonAjax/",
    dataType: "json",
    data    : {
      surname   : surname,
      firstname : firstname,
      middlename: middlename,
      inn       : inn
    },
    success : data,
    error   : 'error'
  });
}

function emp2findCompanyAjax(name, ogrn, inn, kpp, okopf, data) {
  $('.loading').show();
  ajaxSetup();
  $.ajax({
    url     : "/emp2FindCompanyAjax/",
    dataType: "json",
    data    : {
      company: name,
      inn    : inn,
      ogrn  : ogrn,
      kpp : kpp,
      okopf : okopf
    },
    success : data,
    error   : 'error'
  });
}

function findIpAjax(person_id, data) {
  $('.loading').show();
  ajaxSetup();
  $.ajax({
    url     : "/findIpAjax/",
    dataType: "json",
    data    : {
      person_id: person_id
    },
    success : data,
    error   : 'error'
  });
}

function emp2_findPerson(surname, firstname, middlename, inn) {
  emp2FindPersonAjax(surname, firstname, middlename, inn, function (result) {
    $('.loading').hide();
    if (result.success) {
      let data = result.success;
      if (data.length != 0) {
        $('#emp2-person-msg').html('<h4 id="emp2-ip-msg-header">Выполняется поиск:</h4>');
        $('#emp2-person-msg').addClass('alert-success');
        $('#emp2-person-msg').removeClass('alert-danger');
        for (var key in data) {
          let data_ip = data[key];
          if (data_ip.length != 0) {
            $('#emp2-ip-msg-header').html('Найдены индивидуальные предприниматели:');
            $('#emp2-person-msg').append('<div class="person-block" id="person-' + data_ip[0].id + '">' +
              data_ip[0].person.fullNameWithInn +
              '<div class="bank-fields">ОГРНИП: ' + data_ip[0].ogrn + '</div>' +
              '<div class="bank-fields">Дата регистрации: ' + data_ip[0].ogrnDate + '</div>' +
              '<hr/>' +
              '<button class="btn btn-primary id="emp2-select-person" data-personid="' + data_ip[0].id + '" id="emp2-select-person-'
              + data_ip[0].id + '">Выбрать</button>' +
              '</div>');
          }
        }
      } else {
        $('#emp2-person-msg').html('<h4>Данные об индивидуальных предпринимателях не найдены!</h4>');
        $('#emp2-person-msg').addClass('alert-danger');
        $('#emp2-person-msg').removeClass('alert-success');
      }
    } else {
      $('#emp2-person-msg').html('<h4>Ошибка!</h4>');
      $('#emp2-person-msg').addClass('alert-danger');
      $('#emp2-person-msg').removeClass('alert-success');
    }
  });
}

function emp2_findCompany(name, ogrn, inn, kpp) {
  emp2findCompanyAjax(name, ogrn, inn, kpp, '', function(result){
    $('.loading').hide();
    let data = result.success;
    if (data.length != 0) {
      $('#emp2-company-msg').html('<h4 id="search-title">Найдены компании:</h4>');
      $('#emp2-company-msg').addClass('alert-success');
      $('#emp2-company-msg').removeClass('alert-danger');
      for (var key in data) {
        let company_detail = data[key];
        if (company_detail) {
          let okopf_string = '';
          let mainOkved1_string = '';
          let pfrRegistration_string = '';
          let fssRegistration_string = '';
          let address_string = '';
          let company_string = (company_detail.name != undefined) ? ('<b>' + company_detail.name + '</b><br/>') : '';
          let inn_string = (company_detail.inn != undefined) ? ('<span class="bank-fields"><b>ИНН: </b>' + company_detail.inn
            + '<br/></span>') : '';
          let kpp_string = (company_detail.kpp != undefined) ? ('<span class="bank-fields"><b>КПП: </b>' + company_detail.kpp
            + '<br/></span>') : '';
          let ogrn_string = (company_detail.ogrn != undefined) ? ('<span class="bank-fields"><b>ОГРН: </b>' + company_detail.ogrn
            + '<br/></span>') : '';
          if (company_detail.okopf) {
            okopf_string = (company_detail.okopf.fullName && company_detail.okopf.fullName != undefined) ? ('<span class="bank-fields">' +
              '<b>Правовая форма: </b>' + company_detail.okopf.fullName + '<br/></span>') : '';
          }
          if (company_detail.address) {
            address_string = (company_detail.address.fullHouseAddress && company_detail.address.fullHouseAddress != undefined) ?
              ('<b>Юридический адрес: </b>' + company_detail.address.fullHouseAddress + '<br/>') : '';
          }
          if (company_detail.mainOkved1) {
            mainOkved1_string = (company_detail.mainOkved1.fullName && company_detail.mainOkved1.fullName != undefined)
              ? ('<span class="bank-fields"><b>Основной ОКВЭД: </b>' + company_detail.mainOkved1.fullName + '<br/></span>') : '';
          }
          if (company_detail.pfrRegistration) {
            pfrRegistration_string = (company_detail.pfrRegistration.pfr.fullName && company_detail.pfrRegistration.pfr.fullName != undefined)
              ? ('<span class="bank-fields"><b>ПФР: </b>' + company_detail.pfrRegistration.pfr.fullName + '<br/></span>') : '';
          }
          if (company_detail.fssRegistration) {
            fssRegistration_string = (company_detail.fssRegistration.fss.fullName && company_detail.fssRegistration.fss.fullName != undefined)
              ? ('<span class="bank-fields"><b>ФСС: </b>' + company_detail.fssRegistration.fss.fullName + '<br/></span>') : '';
          }
          $('#emp2-company-msg').append('<div class="company-block" id="company-' + company_detail.id + '">' +
            company_string +
            inn_string +
            kpp_string +
            ogrn_string +
            '<span class="bank-fields"><b>Краткое название: </b>' + company_detail.shortName + '<br/></span>' +
            okopf_string +
            '<span class="bank-fields"><b>Дата регистрации: </b>' + company_detail.ogrnDate + '<br/></span>' +
            address_string +
            '<div><label><input type="checkbox" checked class="fact-address-checkbox"> Фактический адрес совпадает с юридическим</label></div>' +
            '<div class="fact-address"><label> Адрес</label>' +
            '<input type="text" class="form-control"></div>' +
            mainOkved1_string +
            pfrRegistration_string +
            fssRegistration_string +
            '<hr/>' +
            '<button class="btn btn-primary emp-select-company" data-companyid="' + company_detail.id + '" id="emp-select-company-'
            + company_detail.id + '">Выбрать</button>' +
            '</div>');
        } else {
          $('#emp2-company-msg').html('<h4>Данные о компаниях не найдены!</h4>');
          $('#emp2-company-msg').addClass('alert-danger');
          $('#emp2-company-msg').removeClass('alert-success');
        }
      }
    }
  });
}

function getCompany(organisation, okopf, inn) {
  $('.loading').show();
  ajaxSetup();
  if (okopf == '50102') {
    let surname = organisation.split(' ')[0];
    let firstname = organisation.split(' ')[1];
    let middlename = organisation.split(' ')[2];
    emp2FindPersonAjax(surname, firstname, middlename, '', function (result) {
      if (result.success) {
        $('.loading').hide();
        let data = result.success;
        if (data.length != 0) {
          $('#emp-msg').html('<h4>Найдены данные об индивидуальных предпринимателях:</h4>');
          $('#emp-msg').addClass('alert-success');
          $('#emp-msg').removeClass('alert-danger');
          for (var key in data) {
            let data_ip = data[key];
            if (data_ip.length != 0) {
              $('#emp-msg').append('<div class="person-block" id="person-' + data_ip[0].id + '">' +
                data_ip[0].person.fullNameWithInn +
                '<div class="bank-fields">ОГРНИП: ' + data_ip[0].ogrn + '</div>' +
                '<div class="bank-fields">Дата регистрации: ' + data_ip[0].ogrnDate + '</div>' +
                '<hr/>' +
                '<button class="btn btn-primary id="emp-select-person" data-personid="' + data_ip[0].id + '" id="emp-select-person-'
                + data_ip[0].id + '">Выбрать</button>' +
                '</div>');
            }
          }
        } else {
          $('#emp-msg').html('<h4>Данные об индивидуальных предпринимателях не найдены!</h4>');
          $('#emp-msg').addClass('alert-danger');
          $('#emp-msg').removeClass('alert-success');
        }
      } else {
        $('#emp-msg').html('<h4>Ошибка!</h4>');
        $('#emp-msg').addClass('alert-danger');
        $('#emp-msg').removeClass('alert-success');
      }
    });
  } else {
    emp2findCompanyAjax(organisation, '', inn, '', okopf, function(result){
      if (result.success) {
        $('.loading').hide();
        let data = result.success;
        if (data.length != 0) {
          $('#emp-msg').html('<h4 id="search-title">Найдены компании:</h4>');
          $('#emp-msg').addClass('alert-success');
          $('#emp-msg').removeClass('alert-danger');
          for (var key in data) {
            let company_detail = data[key];
            if (company_detail) {
              let okopf_string = '';
              let mainOkved1_string = '';
              let pfrRegistration_string = '';
              let fssRegistration_string = '';
              let address_string = '';
              let company_string = (company_detail.name != undefined) ? ('<b>' + company_detail.name + '</b><br/>') : '';
              let inn_string = (company_detail.inn != undefined) ? ('<span class="bank-fields"><b>ИНН: </b>' + company_detail.inn
                + '<br/></span>') : '';
              let kpp_string = (company_detail.kpp != undefined) ? ('<span class="bank-fields"><b>КПП: </b>' + company_detail.kpp
                + '<br/></span>') : '';
              let ogrn_string = (company_detail.ogrn != undefined) ? ('<span class="bank-fields"><b>ОГРН: </b>' + company_detail.ogrn
                + '<br/></span>') : '';
              if (company_detail.okopf) {
                okopf_string = (company_detail.okopf.fullName && company_detail.okopf.fullName != undefined) ? ('<span class="bank-fields">' +
                  '<b>Правовая форма: </b>' + company_detail.okopf.fullName + '<br/></span>') : '';
              }
              if (company_detail.address) {
                address_string = (company_detail.address.fullHouseAddress && company_detail.address.fullHouseAddress != undefined) ?
                  ('<b>Юридический адрес: </b>' + company_detail.address.fullHouseAddress + '<br/>') : '';
              }
              if (company_detail.mainOkved1) {
                mainOkved1_string = (company_detail.mainOkved1.fullName && company_detail.mainOkved1.fullName != undefined)
                  ? ('<span class="bank-fields"><b>Основной ОКВЭД: </b>' + company_detail.mainOkved1.fullName + '<br/></span>') : '';
              }
              if (company_detail.pfrRegistration) {
                pfrRegistration_string = (company_detail.pfrRegistration.pfr.fullName && company_detail.pfrRegistration.pfr.fullName != undefined)
                  ? ('<span class="bank-fields"><b>ПФР: </b>' + company_detail.pfrRegistration.pfr.fullName + '<br/></span>') : '';
              }
              if (company_detail.fssRegistration) {
                fssRegistration_string = (company_detail.fssRegistration.fss.fullName && company_detail.fssRegistration.fss.fullName != undefined)
                  ? ('<span class="bank-fields"><b>ФСС: </b>' + company_detail.fssRegistration.fss.fullName + '<br/></span>') : '';
              }
              $('#emp-msg').append('<div class="company-block" id="company-' + company_detail.id + '">' +
                company_string +
                inn_string +
                kpp_string +
                ogrn_string +
                '<span class="bank-fields"><b>Краткое название: </b>' + company_detail.shortName + '<br/></span>' +
                okopf_string +
                '<span class="bank-fields"><b>Дата регистрации: </b>' + company_detail.ogrnDate + '<br/></span>' +
                address_string +
                '<div><label><input type="checkbox" checked class="fact-address-checkbox"> Фактический адрес совпадает с юридическим</label></div>' +
                '<div class="fact-address"><label> Адрес</label>' +
                '<input type="text" class="form-control"></div>' +
                mainOkved1_string +
                pfrRegistration_string +
                fssRegistration_string +
                '<hr/>' +
                '<button class="btn btn-primary emp-select-company" data-companyid="' + company_detail.id + '" id="emp-select-company-'
                + company_detail.id + '">Выбрать</button>' +
                '</div>');
            } else {
              $('#emp-msg').html('<h4>Данные о компаниях не найдены!</h4>');
              $('#emp-msg').addClass('alert-danger');
              $('#emp-msg').removeClass('alert-success');
            }
          }
        }
      }
    });
  }
}

function fsspPerson(fssp_region, fssp_name, fssp_thirdname, fssp_surname, fssp_birthdate) {
  $('.loading').show();
  $('#fssp-person-msg').empty();
  $('#fssp-person-status').empty();
  $('#fssp-person-result').empty();
  $('#fssp-person-msg').removeClass('alert-danger');
  $('#fssp-person-status').removeClass('alert-danger');
  $('#fssp-person-result').removeClass('alert-danger');
  $('#fssp-person-msg').removeClass('alert-success');
  $('#fssp-person-status').removeClass('alert-success');
  $('#fssp-person-result').removeClass('alert-success');
  ajaxSetup();
  $.ajax({
    url     : "/fsspPersonAjax/",
    dataType: "json",
    data    : {
      fssp_region   : fssp_region,
      fssp_name     : fssp_name,
      fssp_thirdname: fssp_thirdname,
      fssp_surname  : fssp_surname,
      fssp_birthdate: fssp_birthdate
    },
    success : function (data) {
      $('.loading').hide();
      if (data.status = 'success') {
        $('#fssp-person-task').val(data.response.task);
        $('#fssp-person-msg').html('<h4>Ваш запрос отправлен на обработку</h4>' +
          '<button class="btn btn-primary" id="fssp-person-check-status-button">Проверить статус заявки</button>');
        $('#fssp-person-msg').addClass('alert-success');
        $('#fssp-person-msg').removeClass('alert-danger');
      } else {
        $('#fssp-person-msg').html('<h4>Ошибка</h4>');
        $('#fssp-person-msg').addClass('alert-danger');
        $('#fssp-person-msg').removeClass('alert-success');
      }
    }
  });
}

function fsspPersonStatus(fssp_task) {
  $('.loading').show();
  ajaxSetup();
  $.ajax({
    url     : "/fsspPersonStatusAjax/",
    dataType: "json",
    data    : {
      fssp_task: fssp_task
    },
    success : function (data) {
      $('.loading').hide();
      if (data.status = 'success') {
        switch (data.response.status) {
          case 0:
            $('#fssp-person-status').html('<h4>Задача находится в очереди на выполнение</h4>');
            $('#fssp-person-status').addClass('alert-success');
            $('#fssp-person-status').removeClass('alert-danger');
            break;
          case 1:
            $('#fssp-person-status').html('<h4>Задача находится в обработке</h4>');
            $('#fssp-person-status').addClass('alert-success');
            $('#fssp-person-status').removeClass('alert-danger');
            break;
          case 2:
            $('#fssp-person-status').html('<h4>Задача выполнена без ошибок</h4>' +
              '<button class="btn btn-primary" id="fssp-person-result-button">Посмотреть результат</button>');
            $('#fssp-person-status').addClass('alert-success');
            $('#fssp-person-status').removeClass('alert-danger');
            break;
          case 3:
            $('#fssp-person-status').html('<h4>Задача выполнена, имеются ошибки</h4>');
            $('#fssp-person-status').removeClass('alert-success');
            $('#fssp-person-status').addClass('alert-danger');
            break;
        }
      } else {
        $('#fssp-person-status').html('<h4>Ошибка</h4>');
        $('#fssp-person-status').addClass('alert-danger');
        $('#fssp-person-status').removeClass('alert-success');
      }
    }
  });
}

function fsspPersonResult(fssp_task) {
  $('.loading').show();
  ajaxSetup();
  $.ajax({
      url     : "/fsspPersonResultAjax/",
      dataType: "json",
      data    : {
        fssp_task: fssp_task
      },
      success : function (data) {
        $('.loading').hide();
        if (data.status = 'success') {
          $('#fssp-person-result').addClass('alert-success');
          $('#fssp-person-result').removeClass('alert-danger');
          if (data.response.result[0].result != null) {
            if (data.response.result[0].result.length > 0) {
              $('#fssp-person-result').html('<h4>Исполнительные производства:</h4>');
              for (var key in data.response.result[0].result) {
                $('#fssp-person-result').append(
                  data.response.result[0].result[key].name + '<br/>' +
                  data.response.result[0].result[key].exe_production + '<br/>' +
                  data.response.result[0].result[key].details + '<br/>' +
                  data.response.result[0].result[key].subject + '<br/>' +
                  data.response.result[0].result[key].department + '<br/>' +
                  data.response.result[0].result[key].bailiff + '<br/>' +
                  data.response.result[0].result[key].ip_end + '<br/>' +
                  '<hr/>');
              }
            } else {
              $('#fssp-person-result').html('<h4>Нет исполнительных производств</h4>');
            }
          } else {
            $('#fssp-person-result').html('<h4>Нет исполнительных производств</h4>');
          }
        } else {
          $('#fssp-person-result').html('<h4>Ошибка</h4>');
          $('#fssp-person-result').addClass('alert-danger');
          $('#fssp-person-result').removeClass('alert-success');
        }
      }
    }
  )
  ;
}

function personReadMore(person_id) {
  $('.loading').show();
  ajaxSetup();
  $.ajax({
    url     : "/personReadMoreAjax/",
    dataType: "json",
    data    : {
      person_id: person_id
    },
    success : function (data) {
      $('.loading').hide();
      console.log(data);
      let person_workplaces = JSON.parse(data.success.person_workplaces);
      let person_companies = JSON.parse(data.success.person_companies);
      let person_ip = JSON.parse(data.success.person_ip);
      $('#person-readmore-' + person_id).hide();
      if (person_workplaces.length != 0) {
        $('#person-' + person_id).append('<b>Информация о местах работы:</b> <br/>');
        for (var key in person_workplaces) {
          $('#person-' + person_id).append('<b>Компания: </b>' + person_workplaces[key].company.name + '<br/>' +
            '<b>Должность: </b>' + person_workplaces[key].postName + '<hr/>');
        }
      } else {
        $('#person-' + person_id).append('<b>Информация о местах работы не найдена</b><hr/>');
      }
      if (person_companies.length != 0) {
        $('#person-' + person_id).append('<b>Информация о собственных компаниях: </b><br/>');
        for (var key in person_companies) {
          $('#person-' + person_id).append(
            '<b>Компания: </b>' + person_companies[key].name + '<br/>' +
            '<b>ОГРН: </b>' + person_companies[key].ogrn + '<br/>' +
            '<b>ИНН: </b>' + person_companies[key].inn + '<br/>' +
            '<b>КПП: </b>' + person_companies[key].kpp + '<hr/>');
        }
      } else {
        $('#person-' + person_id).append('<b>Информация о собственных компаниях не найдена</b><hr/>');
      }
      if (person_ip.length != 0) {
        $('#person-' + person_id).append('<b>Информация об ИП: </b><br/>');
        for (var key in person_ip) {
          $('#person-' + person_id).append(
            '<b>ОГРН: </b>' + person_ip[key].ogrn + '<hr/>');
        }
      } else {
        $('#person-' + person_id).append('<b>Информация об ИП не найдена</b><hr/>');
      }
    }
  });
}

function companyReadMore(company_id) {
  $('.loading').show();
  ajaxSetup();
  $.ajax({
    url     : "/companyReadMoreAjax/",
    dataType: "json",
    data    : {
      company_id: company_id
    },
    success : function (data) {
      $('.loading').hide();
      let company_info = data.success;
      let okopf_string = '';
      let mainOkved1_string = '';
      let pfrRegistration_string = '';
      let fssRegistration_string = '';
      if (company_info.okopf) {
        okopf_string = (company_info.okopf.fullName && company_info.okopf.fullName != undefined) ? ('<b>Правовая форма: </b>' + company_info.okopf.fullName + '<br/>') : '';
      }
      if (company_info.mainOkved1) {
        mainOkved1_string = (company_info.mainOkved1.fullName && company_info.mainOkved1.fullName != undefined) ? ('<b>Основной ОКВЭД: </b>' + company_info.mainOkved1.fullName + '<br/>') : '';
      }
      if (company_info.pfrRegistration) {
        pfrRegistration_string = (company_info.pfrRegistration.pfr.fullName && company_info.pfrRegistration.pfr.fullName != undefined) ? ('<b>ПФР: </b>' + company_info.pfrRegistration.pfr.fullName + '<br/>') : '';
      }
      if (company_info.fssRegistration) {
        fssRegistration_string = (company_info.fssRegistration.fss.fullName && company_info.fssRegistration.fss.fullName != undefined) ? ('<b>ФСС: </b>' + company_info.fssRegistration.fss.fullName + '<br/>') : '';
      }
      $('#company-readmore-' + company_id).hide();
      if (company_info.length != 0) {
        $('#company-' + company_id).append('<b>Подробная информация: </b><br/>');
        $('#company-' + company_id).append(
          '<b>Краткое название: </b>' + company_info.shortName + '<br/>' +
          okopf_string +
          '<b>Дата регистрации: </b>' + company_info.ogrnDate + '<br/>' +
          '<b>Адрес: </b>' + company_info.address.fullHouseAddress + '<br/>' +
          mainOkved1_string +
          pfrRegistration_string +
          fssRegistration_string +
          '<br/>' +
          '<span class="readmore-financical" data-companyid="' + company_id + '" id="company-financical-' + company_id + '">Посмотреть бухгалтерскую отчетность..</span>' +
          '<hr/>');
      } else {
        $('#company-' + company_id).append('<b>Подробная информация не найдена</b><hr/>');
      }
    }
  });
}

function companyFinancical(company_id) {
  ajaxSetup();
  $.ajax({
    url     : "/companyFinancicalAjax/",
    dataType: "json",
    data    : {
      company_id: company_id
    },
    success : function (data) {
      let company_financical = data.company_financical;
      console.log(company_financical)
      $('#company-financical-' + company_id).hide();
      if (company_financical) {
        $('#company-' + company_id).append('<b>Бухгалтерская отчетность: </b><br/>');
        for (var key in company_financical) {
          $('#company-' + company_id).append('<h4>Год: ' + company_financical[key].year + '</h4>');
          for (var key2 in company_financical[key].props) {
            $('#company-' + company_id).append('<b>' + company_financical[key].props[key2].title + '</b>: ' + company_financical[key].props[key2].value + company_financical[key].money_code + '<br/>');
          }
        }
      } else {
        $('#company-' + company_id).append('<b>Бухгалтерская отчетность не найдена</b><hr/>');
      }
    }
  });
}

function underwritingPerson(ur_surname, ur_name, ur_thirdname, ur_inn) {
  $('.loading').show();
  findPersonAjax(ur_surname, ur_name, ur_thirdname, ur_inn, function(result){
    $('.loading').hide();
    if (result.success) {
      let person = result.success;
      if (person.length != 0) {
        $('#ur-person-msg').html('<h4>Найдены данные о людях:</h4>');
        $('#ur-person-msg').addClass('alert-success');
        $('#ur-person-msg').removeClass('alert-danger');
        for (var key in person) {
          $('#ur-person-msg').append('<div class="person-block" id="person-' + person[key].id + '">' +
            person[key].fullNameWithInn +
            '<hr/>' +
            '<span class="readmore" data-personid="' + person[key].id + '" id="person-readmore-' + person[key].id + '">Подробнее..</span>' +
            '</div>');
        }
      } else {
        $('#ur-person-msg').html('<h4>Данные о людях не найдены!</h4>');
        $('#ur-person-msg').addClass('alert-danger');
        $('#ur-person-msg').removeClass('alert-success');
      }
    }
  });
}

function underwritingCompany(ur_company, ur_ogrn, ur_inn, ur_kpp) {
  $('.loading').show();
  ajaxSetup();
  $.ajax({
    url     : "/underwritingCompanyAjax/",
    dataType: "json",
    data    : {
      ur_company: ur_company,
      ur_ogrn   : ur_ogrn,
      ur_inn    : ur_inn,
      ur_kpp    : ur_kpp
    },
    success : function (data) {
      $('.loading').hide();
      let company = data.success;
      if (company.length != 0) {
        $('#ur-company-msg').html('<h4>Найдены данные о компаниях:</h4>');
        $('#ur-company-msg').addClass('alert-success');
        $('#ur-company-msg').removeClass('alert-danger');
        for (var key in company) {
          let company_string = (company[key].name != undefined) ? ('<b>' + company[key].name + '</b><br/>') : '';
          let inn_string = (company[key].inn != undefined) ? ('<b>ИНН: </b>' + company[key].inn + '<br/>') : '';
          let kpp_string = (company[key].kpp != undefined) ? ('<b>КПП: </b>' + company[key].kpp + '<br/>') : '';
          let ogrn_string = (company[key].ogrn != undefined) ? ('<b>ОГРН: </b>' + company[key].ogrn + '<br/>') : '';
          $('#ur-company-msg').append('<div class="company-block" id="company-' + company[key].id + '">' +
            company_string +
            inn_string +
            kpp_string +
            ogrn_string +
            '<hr/>' +
            '<span class="readmore" data-companyid="' + company[key].id + '" id="company-readmore-' + company[key].id + '">Подробнее..</span>' +
            '</div>');
        }
      } else {
        $('#ur-company-msg').html('<h4>Данные о компаниях не найдены!</h4>');
        $('#ur-company-msg').addClass('alert-danger');
        $('#ur-company-msg').removeClass('alert-success');
      }
    }
  });
}

function del_spaces(str) {
  str = str.replace(/\s/g, '');
  return str;
}

function checkCardNumber(cardnumber) {
  ajaxSetup();
  cardnumber = Number(del_spaces(cardnumber));
  $.ajax({
    url     : "/cardcheckAjax/",
    dataType: "json",
    data    : {
      cardnumber: cardnumber
    },
    success : function (data) {
      $('#cardnumber-msg').html('Success!<br/>' +
        'BIN: ' + data.bin + '<br/>' +
        'ПЛАТЕЖНАЯ СИСТЕМА: ' + data.brand + '<br/>' +
        'ВЫДАНА БАНОКОМ: ' + data.issuer + '<br/>' +
        'ТИП КАРТЫ: ' + data.type + '<br/>' +
        'КАТЕГОРИЯ КАРТЫ: ' + data.category + '<br/>' +
        'СТРАНА: ' + data.country_name);
      $('#cardnumber-msg').addClass('alert-success');
    }
  });
}

function checkTerrorist(ter_surname, ter_name, ter_thirdname) {
  ajaxSetup();
  $.ajax({
    url     : "/terroristCheckAjax/",
    dataType: "json",
    data    : {
      ter_surname  : ter_surname,
      ter_name     : ter_name,
      ter_thirdname: ter_thirdname
    },
    success : function (data) {
      if (data.length > 0) {
        $('#ter-msg').html('<h4>Найдены совпадения по базе террористов!</h4>');
        $('#ter-msg').removeClass('alert-success');
        $('#ter-msg').addClass('alert-danger');
        data.forEach(function (item) {
          $('#ter-msg').append(item.surname + ' ' + item.name + ' ' + item.thirdname + ', ' + item.birthdate + ' г. р., ' +
            item.birthplace + '<br/>');
        });
      } else {
        $('#ter-msg').html('<h4>Совпадений по базе террористов не найдено!</h4>');
        $('#ter-msg').addClass('alert-success');
        $('#ter-msg').removeClass('alert-danger');
      }
    }
  });
}

function sendSignEmail(sign_name, sign_email) {
  ajaxSetup();
  $.ajax({
    url     : "/docusignAjax/",
    dataType: "json",
    data    : {
      name : sign_name,
      email: sign_email
    },
    success : function (data) {
      console.log(data);
      $('#sign-msg').text('Success!');
      $('#sign-msg').addClass('alert-success');
    }
  });
}

function ajaxSetup() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
}

//Если с английского на русский, то передаём вторым параметром true.
transliterate = (function () {
  var
    rus = "щ   ш  ч  ц  ю  я  ё  ж  ъ  ы  э  а б в г д е з и й к л м н о п р с т у ф х ь".split(/ +/g),
    eng = "shh sh ch cz yu ya yo zh `` y' e` a b v g d e z i j k l m n o p r s t u f x `".split(/ +/g)
  ;
  return function (text, engToRus) {
    var x;
    for (x = 0; x < rus.length; x++) {
      text = text.split(engToRus ? eng[x] : rus[x]).join(engToRus ? rus[x] : eng[x]);
      text = text.split(engToRus ? eng[x].toUpperCase() : rus[x].toUpperCase()).join(engToRus ? rus[x].toUpperCase() : eng[x].toUpperCase());
    }
    return text;
  }
})();

function checkTranslate(cyr_name, lat_name) {
  ajaxSetup();
  $.ajax({
    url     : "/nameCheckAjax/",
    dataType: "json",
    data    : {
      cyr_name: cyr_name,
      lat_name: lat_name
    },
    success : function (data) {
      if (data.success) {
        $('#transliterate-msg').addClass('alert-success');
        $('#transliterate-msg').removeClass('alert-danger');
        $('#transliterate-msg').empty();
        $('#transliterate-msg').append('Все верно!');
      } else {
        $('#transliterate-msg').removeClass('alert-success');
        $('#transliterate-msg').addClass('alert-danger');
        $('#transliterate-msg').empty();
        $('#transliterate-msg').append('Возможно правильный вариант: ' + transliterate(cyr_name).toUpperCase());
      }
    }
  });
}