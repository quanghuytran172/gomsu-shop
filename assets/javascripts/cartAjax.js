function updateCart(productCode) {
    var input = $("#" + productCode);
    if (input.val() < 1) {
        $(input.val(0));
    }
    $.ajax({
        url: "cart/updateAjax",
        type: "POST",
        data: {
            quantity: input.val(),
            productCode: productCode,
        },
        success: (res) => {
            $("#list-cart").load("cart #list-cart");
            $("#checkout_check").load("cart #checkout_check");
        },
    });
}

$(document).ready(function () {
    $("body").on("click", ".add_to_cart_product", function () {
        var productCode = $(this).attr("data-product-id");
        $(this).next().show();
        $(this).hide();
        $.ajax({
            url: "cart/addAjax",
            type: "POST",
            data: {
                productCode: productCode,
            },
            success: (res) => {
                setTimeout(() => {
                    $(this).next().hide();
                    $(this).show();
                    $(".nCart").html(res);
                }, 1000);
            },
        });
    });
    $("body").on("click", "#remove_item_cart", function () {
        var productCode = $(this).attr("data-product_id");
        $.ajax({
            url: "cart/deleteAjax",
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
