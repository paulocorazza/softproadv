// Forma 1
$("#checkAll").click(function(e){
    e.preventDefault()

    $('input:checkbox').prop("checked", true);
});

$("#UnCheckAll").click(function(e){
    e.preventDefault()

    $('input:checkbox').prop("checked", false);
});
