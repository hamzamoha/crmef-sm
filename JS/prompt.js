$(document).ready(function (e) {
    $(".prompt form input[type=button][name=cancel]#cancel, .prompt").click(function () {
        $(this).closest(".prompt").hide();
    });
    $(".prompt > *").click(function (e) {
        e.stopPropagation();
    });
    $(document).keydown(function (e) {
        if (e.which == 27) {
            $(".prompt").hide();
        }
    });
});