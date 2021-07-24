
$(document).on('click','#links_audiences .pagination a', function(e){
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    getAudiences(page)
});

$(document).on('click','#links_events .pagination a', function(e){
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    getEvents(page)
});


$(document).on('click','#links_progress .pagination a', function(e){
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    getProgress(page)
});


function getEvents(page){
    $.ajax({
        url: '/home?page=' + page,
        data: {
            events : true
        }
    }).done(function(data){
        $('#tabela_events').html(data);

    });
}

function getAudiences(page){
    $.ajax({
        url: '/home?page=' + page,
        data: {
            audiences : true
        }
    }).done(function(data){
        $('#tabela_audience').html(data);

    });
}

function getProgress(page){
    $.ajax({
        url: '/home?page=' + page,
        data: {
            progress : true
        }
    }).done(function(data){
        $('#tabela_progress').html(data);

    });
}
