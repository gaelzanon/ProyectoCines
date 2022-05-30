/*$('#myForm').on('submit', function (e) {
    $('#myModal').modal('show');
    e.preventDefault();
});*/

$(document).ready(function () {
    $(".Test").click(function () { // Click to only happen on announce links
        $("#nombre").val($(this).data('id'));
        $('#myModal').modal('show');
    });
});