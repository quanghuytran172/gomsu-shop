$(document).ready(function () {
    $("body").on("click", ".add_to_wishlist", function () {
        var productCode = $(this).attr("data-product-id");
        $(this).next().show();
        $(this).hide();
        $.ajax({
            url: "wishlist/addAjax",
            type: "POST",
            data: {
                productCode: productCode,
            },
            success: (res) => {
                setTimeout(() => {
                    $(this).next().hide();
                    $(this).show();
                    $(".favourite").html(res);
                }, 1000);
            },
        });
    });
    $("body").on("click", "#remove_item_wishlist", function () {
        var productCode = $(this).attr("data-product_id");
        $.ajax({
            url: "wishlist/deleteAjax",
            type: "POST",
            data: {
                productCode: productCode,
            },
            success: (res) => {
                if (res == "1") {
                    location.reload();
                }
            },
        });
    });
});
