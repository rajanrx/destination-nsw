
$(document).ready(function(){
    $.ajax({
        url: "/functions.php?action=listall",
    }).success(function(msg) {
        $("#content").html(msg);
    });
});

function initiateModal(){

    $(".displayModal").click(function(){

        var link = $(this).attr('href');
        var detailModalDiv = $("#detailModal");
        detailModalDiv.find(".modal-body").html('Loading...');
        detailModalDiv.find(".modal-title").text($(this).data('productName'));
        detailModalDiv.modal();

        $.ajax({
            url: link,
        }).success(function(msg) {
            detailModalDiv.find(".modal-body").html(msg);
        });

        return false;

    })
}

