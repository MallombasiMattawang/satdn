// jika form-prevent disubmit maka disable button-prevent dan tampilkan spinner
(function () {
    $(".form-prevent").on("submit", function () {
        $(".button-prevent").attr("disabled", "true");
        $(".spinner").show();
        $(".hide-text").hide();
    });
})();

$(document).ready(function ($) {
    $(".div-search div").each(function () {
        $(this).attr("searchData", $(this).text().toLowerCase());
    });
    $(".form-search").on("keyup", function () {
        var dataList = $(this).val().toLowerCase();
        $(".div-search div").each(function () {
            if (
                $(this).filter("[searchData *= " + dataList + "]").length > 0 ||
                dataList.length < 1
            ) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
