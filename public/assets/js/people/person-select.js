$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#people').select2({
    theme: "classic",
    allowClear: true,
    placeholder: 'Selecione a Pessoa',

    ajax: {
        delay: 250,
        type: 'post',
        url: url_base + '/people/search',

        data: function (params) {
            return {
                q: $.trim(params.term),
            };
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
});


$('#person_id').select2({
    theme: "classic",
    allowClear: true,
    placeholder: 'Selecione a Pessoa',

    ajax: {
        delay: 250,
        type: 'post',
        url: url_base + '/people/search',

        data: function (params) {
            return {
                q: $.trim(params.term),
                type: 'Cliente'
            };
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
});

$('#counterpart_id').select2({
    theme: "classic",
    allowClear: true,
    placeholder: 'Selecione a Parte Contrária',

    ajax: {
        delay: 250,
        type: 'post',
        url: url_base + '/people/search',

        data: function (params) {
            return {
                q: $.trim(params.term),
                type: 'Parte Contrária'
            };
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
});


$('#judge_id').select2({
    theme: "classic",
    allowClear: true,
    placeholder: 'Selecione o Juiz',

    ajax: {
        delay: 250,
        type: 'post',
        url: url_base + '/people/search',

        data: function (params) {
            return {
                q: $.trim(params.term),
                type: 'Juiz'
            };
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
});

