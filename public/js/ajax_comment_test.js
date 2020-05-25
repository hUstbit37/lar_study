$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        // alert(page);
        getData(page);
    });
});

function getData(page) {
    $.ajax({
        url: "/ajax2?page=" + page,
        success: function(data) {
            $('#show-comment').html(data);
        }
    });
}
$('.ajax-click').click(function(event) {
    event.preventDefault();
    let URL = $(this).parents('form').attr('action');
    // alert(URL);
    $.ajax({
        url: URL,
        type: "POST",
        data: $('#form_input').serialize(),
    }).done(function(results) {
        $('#show-comment').load(' #show-comment >*');

    });
});