@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('css')
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@endsection

@section('title_postfix', ' - Monitoramento de Andamentos')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => 'Monitoramento de Andamentos',
                                               'breadcrumbs' => [
                                               'Monitoramento de Andamentos', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">
    <!--TABELA -->
    @include('tenants.monitor.partials.table')
    <!--TABELA -->
    </div>
@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>

    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('monitor.progresses') }}';

        var columns = [
            {data: "id"},
            {data: "date"},
            {data: "process.number_process", name : 'process.number_process'},
            {data: "process.person.name", name : 'process.person.name'},
            {data: "description_limit"},
            {
                data: 'action',
                orderable: false
            }
        ]


        $('#tabela').DataTable({
            "processing": true,
            "serverSide": true,
            "deferRender": true,

            "ajax": {
                url: urlAjax,
            },

            "columns": columns,

            columnDefs: [
            {
                targets: 0,
                render: function (data, type, row) {

                    if (type === 'display') {
                        let id = data
                        return `<input data-id=${id} type="checkbox" class="editor-active">`;
                    }
                    return data;
                },
                className: "dt-body-center",
                orderable: false,
                searchable: false
            },
            ],

            paging: true,
            searching: true,
            ordering: true,
            dom: 'lBfrtip',
            "iDisplayLength": 10,
            "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"] ],
            stateSave: true,

            buttons: [
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: 'Imprimir',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'copy',
                    text: '<i class="fa fa-copy"></i>',
                    titleAttr: 'Copiar',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel"></i>',
                    titleAttr: 'Excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa fa-file-pdf"></i>',
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis'
            ],

            language: {
                sProcessing: "Processando...",
                sLengthMenu: "Mostrar _MENU_ registros   ",
                sZeroRecords: "Não foram encontrados resultados",
                sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registos",
                sInfoEmpty: "Mostrando de 0 até 0 de 0 registos",
                sInfoFiltered: "(filtrado de _MAX_ registos no total)",
                sInfoPostFix: "",
                sSearch: "Procurar:",
                sUrl: "",
                oPaginate: {
                    sFirst: "Primeiro",
                    sPrevious: "Anterior",
                    sNext: "Seguinte",
                    sLast: "Último",
                },
                buttons: {
                    colvis: 'Selecionar colunas',
                    copyTitle: 'Copiar',
                    copySuccess: {
                        1: "Copiado 1 linha para área de transferência",
                        _: "Copiado %d linhas para área de transferência"
                    }
                }
            }
        })

        function allChecked () {
            let arr = []

            $("input.editor-active").each(function( index ) {

                if ($(this).is(':checked') ){
                 arr.push($(this).attr('data-id') )
                }
            })
            return arr
        }


        $('#btnCheck').on('click', function (e) {
           $('input.editor-active').prop("checked", true);
        })

        $('#btnUnCheck').on('click', function (e) {
            $('input.editor-active').prop("checked", false);
        })

        $('#btnPublished').on('click', function (e) {
            e.preventDefault()

           let arr =  allChecked()

            if (arr.length > 0) {
                let dados = new FormData();
                dados.append('id', arr)

                ajaxSumit(dados, '/monitor/published')
            }
        })

        $('#btnArchved').on('click', function (e) {
            e.preventDefault()

            let arr =  allChecked()

            if (arr.length > 0) {
                let dados = new FormData();
                dados.append('id', arr)

                ajaxSumit(dados, '/monitor/archived')
            }
        })


        function ajaxSumit(dados, urlAjax) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                processData: false,
                contentType: false,
                url: urlAjax,
                data: dados,
            }).done(function (data) {
                if (urlAjax == '/monitor/published')
                  alertify.alert('Andamentos publicados com sucesso', function () {
                      window.location.href = window.location.href
                  });


                if (urlAjax == '/monitor/archived')
                    alertify.alert('Andamentos arquivados com sucesso', function () {
                        window.location.href = window.location.href
                    });

            }).fail(function () {
                alertify.alert('Ocorreu um erro na requisição.');
            });
        }


    </script>

@stop




