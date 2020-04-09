var id = '';

function reset() {
    $("#toggleCSS").attr("href", "alertify.default.css");

    alertify.set({
        labels: {
            ok: "Sim",
            cancel: "Não"
        },
        delay: 5000,
        buttonReverse: true,
        buttonFocus: "ok"
    });
}

function limparEndereco() {
    $('#cep').val('');
    $('#street').val('');
    $('#number').val('');
    $('#district').val('');
    $('#complement').val('');
    $('#type_address_id').val("");
    $('#country_id').val("");
    $('#state_id').val(null).trigger('change');
    $("#state_id").empty();
    $('#city_id').val(null).trigger('change');
    $("#city_id").empty();
}


function editAddress(obj) {
    limparEndereco()

    id = $(obj).closest('tr').attr('data-id');
    var cep = $('input[type=text][name="addresses[' + id + '][cep]"]').val();
    var number = $('input[type=text][name="addresses[' + id + '][number]"]').val();
    var street = $('input[type=text][name="addresses[' + id + '][street]"]').val();
    var district = $('input[type=text][name="addresses[' + id + '][district]"]').val();
    var complement = $('input[type=hidden][name="addresses[' + id + '][complement]"]').val();
    var type_address_id = $('select[name="addresses[' + id + '][type_address_id]"]').val();
    var country_id = $('input[type=hidden][name="addresses[' + id + '][country_id]"]').val();
    var state_id = $('select[name="addresses[' + id + '][state_id]"]').val();
    var state = $('select[name="addresses[' + id + '][state_id]"] option:selected').text().trim()
    var city_id = $('select[name="addresses[' + id + '][city_id]"]').val();
    var city = $('select[name="addresses[' + id + '][city_id]"] option:selected').text().trim()


    $('#cep').val(cep);
    $('#street').val(street);
    $('#number').val(number);
    $('#district').val(district);
    $('#complement').val(complement);
    $('#type_address_id').val(type_address_id);
    $('#type_address_id').trigger('change');
    $('#country_id').val(country_id);
    $('#country_id').trigger('change');


    var dataState = {
        id: state_id,
        text: state
    };

    var newOption = new Option(dataState.text, dataState.id, false, false);
    $('#state_id').append(newOption).trigger('change');


    var dataCity = {
        id: city_id,
        text: city
    };


    var newOption = new Option(dataCity.text, dataCity.id, false, false);
    $('#city_id').append(newOption).trigger('change');


    $('#modalAddress').modal('show');
}

function removeAddress(obj) {
    reset();

    alertify.confirm("Deseja excluir o registro selecionado?", function (e) {
        if (e) {
            var id = $(obj).closest('tr').attr('data-id');

            if (id <= 0) {
                $(obj).closest('tr').remove();
                alertify.success('Registro excluído com sucesso!')

            } else if (id > 0) {
                deletaAjaxAddress(obj, id);
            }
        }
    })
}


function deletaAjaxAddress(obj, id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: deleteAddressAjax,
        type: 'post',
        dataType: 'json',
        data: {
            id: id
        },

        beforeSend: function () {
            $('.form_load').css('display', 'flex');
        },

        success: function (json) {
            $('.form_load').fadeOut(500);

            if (json.result == true) {
                $(obj).closest('tr').remove();
                alertify.success('Registro excluído com sucesso!')
            } else {
                alertify.error('Falha ao excluir o registro!')
            }
        }
    })
}


function searchAdrress(cep) {
    $.ajax({
        url: '/search/' + cep + '/address',
        type: 'get',
        dataType: 'json',

        beforeSend: function () {
            $('.jloadCep').find('.form_load').css('display', 'flex');
        },

        success: function (json) {
            $('.jloadCep').find('.form_load').fadeOut(500);

            if (json.result == true) {

                $('#street').val(json.data.original.logradouro);
                $('#district').val(json.data.original.bairro);
                $('#complement').val(json.data.original.complemento);

                $('#country_id').val(1058);
                $('#country_id').trigger('change');

                var dataState = {
                    id: json.data.original.ibge.substring(0, 2),
                    text: json.data.original.uf.toUpperCase()
                };

                var newOption = new Option(dataState.text, dataState.id, false, false);
                $('#state_id').append(newOption).trigger('change');

                var dataCity = {
                    id: json.data.original.ibge,
                    text: json.data.original.localidade
                };


                var newOption = new Option(dataCity.text, dataCity.id, false, false);
                $('#city_id').append(newOption).trigger('change');

                if (json.data.original.logradouro == '') {
                    $('#street').focus()
                } else {
                    $('#number').focus()
                }

            } else {
                $('.jloadCep').find('.form_load').fadeOut(500);
                alertify.error(json.message)
            }
        }
    })
}


$(document).ready(function () {
    $('#btnEndereco').on('click', function () {
        id = ''
        limparEndereco();
    })


    $('#search_cep').on('click', function () {
        var cep = $('#cep').val();

        if (cep != '') {
            searchAdrress(cep);
        }
    })


    var countAddress = 0;

    $('#btnSaveUpdateAddress').on('click', function (e) {
        e.preventDefault();

        if (id != '')
            countAddress = id

        var type_address_id = $('#type_address_id').val();
        var type_address = $("#type_address_id option:selected").text();
        var street = $('#street').val();
        var number = $('#number').val();
        var district = $('#district').val();

        var city_id = $('#city_id').val();
        var city = $("#city_id option:selected").text();

        var state_id = $('#state_id').val();
        var state = $("#state_id option:selected").text();

        var cep = $('#cep').val();
        var complement = $('#complement').val();
        var country_id = $('#country_id').val();


        if (type_address_id == '') {
            alertify.error('Tipo de endereço é de preenchimento obrigatório!')
            return false
        }

        if (cep == '') {
            alertify.error('Cep é de preenchimento obrigatório!')
            return false
        }

        if (street == '') {
            alertify.error('Endereço é de preenchimento obrigatório!')
            return false
        }

        if (number == '') {
            alertify.error('Número é de preenchimento obrigatório!')
            return false
        }

        if (district == '') {
            alertify.error('Bairro é de preenchimento obrigatório!')
            return false
        }

        if (country_id == '') {
            alertify.error('Pais é de preenchimento obrigatório!')
            return false
        }

        if (city_id == '') {
            alertify.error('Cidade é de preenchimento obrigatório!')
            return false
        }

        if (state_id == '') {
            alertify.error('UF é de preenchimento obrigatório!')
            return false
        }


        var td =
            '<td>' +
            '<input type="hidden" name="addresses[' + countAddress + '][id]"  value="' + countAddress + '"> ' +
            '<input type="hidden" name="addresses[' + countAddress + '][complement]"  value="' + complement + '"> ' +
            '<input type="hidden" name="addresses[' + countAddress + '][country_id]"  value="' + country_id + '"> ' +


            '<select class="form-control" readonly name="addresses[' + countAddress + '][type_address_id]">' +
            '<option value="' + type_address_id + '">' + type_address + '</option>' +
            '</select>' +
            '</td>' +


            '<td>' +
            '<input class="form-control" type="text" readonly name="addresses[' + countAddress + '][street]"  value="' + street + '"> ' +
            '</td>' +

            '<td>' +
            '<input class="form-control" type="text" readonly name="addresses[' + countAddress + '][number]"  value="' + number + '"> ' +
            '</td>' +

            '<td>' +
            '<input class="form-control" type="text" readonly name="addresses[' + countAddress + '][district]"  value="' + district + '"> ' +
            '</td>' +


            '<td>' +
            '<select class="form-control" readonly name="addresses[' + countAddress + '][city_id]">' +
            '<option value="' + city_id + '">' + city + '</option>' +
            '</select>' +
            '</td>' +

            '<td>' +
            '<select class="form-control" readonly name="addresses[' + countAddress + '][state_id]">' +
            '<option value="' + state_id + '">' + state + '</option>' +
            '</select>' +
            '</td>' +


            '<td>' +
            '<input class="form-control" type="text" readonly name="addresses[' + countAddress + '][cep]"  value="' + cep + '"> ' +
            '</td>' +


            '<td>' +
            '<a rel="' + countAddress + '" class="badge bg-yellow" href="javascript:;" onclick="editAddress(this)" >Editar</a>' +

            '<a rel="' + countAddress + '" class="badge bg-danger" href="javascript:;" onclick="removeAddress(this)">Excluir</a>' +
            '</td>';

        if (id != '') {
            $('#address_table').find('.j_list').find('#addresses' + id).html(td);
        } else if (id == '') {
            var novo = '<tr id="addresses' + countAddress + '" data-id ="' + countAddress + '">' + td + '</tr>'

            $('#address_table').append(novo);

            countAddress--;
        }

        $('#modalAddress').modal('hide');
    })


    $('#type_address_id').select2({
        theme: "classic"
    });

    $('#country_id').select2({
        theme: "classic"
    });

    $('#country_id').on("change", function (e) {
        var id = $(this).val();

        if (id != null) {

            $('#state_id').val(null).trigger('change');
            $("#state_id").empty();

            $.ajax({
                url: '/countries/' + id + '/states',
                type: 'GET',
                dataType: 'json',

                beforeSend: function () {
                    $('.jloadState').find('.form_load').css('display', 'flex')
                },

                success: function (data) {
                    $('.jloadState').find('.form_load').fadeOut(500);
                    var states = $.map(data, function (item) {
                        return new Option(item.initials, item.id, false, false)

                    })

                    $('#state_id').append(states);
                    $('#state_id').trigger('change');
                }
            });
        }
    });

    $('#state_id').select2({
        theme: "classic"
    });


    $('#state_id').on("change", function (e) {
        var id = $(this).val();

        if (id != null) {

            $('#city_id').val(null).trigger('change');
            $("#city_id").empty();

            $.ajax({
                url: '/states/' + id + '/cities',
                type: 'GET',
                dataType: 'json',

                beforeSend: function () {
                    $('.jloadCity').find('.form_load').css('display', 'flex')
                },

                success: function (data) {
                    $('.jloadCity').find('.form_load').fadeOut(500);
                    var cities = $.map(data, function (item) {
                        return new Option(item.name, item.id, false, false)

                    })


                    $('#city_id').append(cities);
                }
            });
        }
    });


    $('#city_id').select2({
        theme: "classic"
    });

    /*$('#city_id').select2({
       theme: "classic",
       placeholder: 'Selecione uma cidade',
       ajax: {
           delay: 250,
           type: 'get',
           url: function () {
               var id = $("#state_id").val()
               return '/states/' + id + '/cities';
           },

           dataType: 'json',
           processResults: function (data) {
               return {
                   results: $.map(data, function (item) {
                       return {
                           text: item.name,
                           id: item.id
                       }
                   })
               };
           },
           cache: true
       }
   });    */


    /* $('#state_id').select2({
         theme: "classic",
         placeholder: 'Selecione um estado',
         ajax: {
             delay: 250,
             type: 'get',
             url: function () {
                 var id = $("#country_id").val()
                 return '/countries/' + id + '/states'
             },

             dataType: 'json',
             processResults: function (data) {
                 return {
                     results: $.map(data, function (item) {
                         return {
                             text: item.initials,
                             id: item.id
                         }
                     })
                 };
             },
             cache: true
         }
     });*/


})
