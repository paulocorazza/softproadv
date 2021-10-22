$(document).ready(function () {
   var tabela =  $('#tabela').DataTable({
        "processing": true,
        "serverSide": true,
        "deferRender": true,

        "ajax": {
            url: urlAjax,
            data : function (d) {
                d.concluded_at = $('#status').val()
                d.users = $('#users').val()
            }
        },

        "columns": columns,

        "columnDefs": [{
            "defaultContent": '-',
            "targets": "_all"}
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

    $('.change').change(function (e) {
        tabela.draw()
    })

    $('#users').select2({
        width: 'resolve',
        placeholder: 'Advogado(s)'
    })


});
