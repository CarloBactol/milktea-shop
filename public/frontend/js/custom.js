$(document).ready(function () {
    // load cart-count
    loadCart();

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // load cart-count
    function loadCart() {
        $.ajax({
            type: "GET",
            url: "/load-cart-data",
            success: function (response) {
                $(".cart-count").html("");
                $(".cart-count").html(response.count);
                // alert(response.count);
            },
        });
    }

    // add to cart
    $("#btn-cart").click(function (e) {
        e.preventDefault();

        var category_id = $("#category_id").val();
        var product_id = $(this)
            .closest("#product_data")
            .find("#prod_id")
            .val(); // get product_id
        var bottle_size = $(this)
            .closest("#product_data")
            .find("#bottle_size")
            .val(); // get price
        var sugar_level = $(this)
            .closest("#product_data")
            .find("#sugar_level")
            .val(); // get sugar_level
        var addons = $('input[name="addons[]"]:checked')
            .map(function () {
                return $(this).val();
            })
            .get();
        var product_qty = $(this)
            .closest("#product_data")
            .find("#product_qty")
            .val(); // get product_qty

        // csrf token
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        // Add to cart
        $.ajax({
            type: "POST",
            url: "/add-to-cart",
            data: {
                product_id: product_id,
                bottle_size: bottle_size,
                sugar_level: sugar_level,
                addons: addons,
                product_qty: product_qty,
                category_id: category_id,
            },
            complete: function (xmlHttp) {
                loadCart();
                swal({
                    title: "Added to Cart!",
                    icon: "success",
                });
                if (xmlHttp.status != 200) {
                    top.location.href = "/login";
                }
            },
        });
    });

    // delete cart
    $(".cart_delete").click(function (e) {
        e.preventDefault();

        // csrf token
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        var cart_id = $("#cart_id").val();
        $.ajax({
            type: "POST",
            url: "delete-cart-item",
            data: {
                product_id: cart_id,
            },
            success: function (response) {
                swal({
                    title: response.status,
                    icon: "error",
                    timer: 2000,
                }).then(function () {
                    window.location.href = "/cart";
                });
            },
        });
    });

    // increment cart quantity
    $("#increment").click(function (e) {
        e.preventDefault();

        var product_qty = $("#product_qty").val();
        var value = parseInt(product_qty, 10); // check if is a number and not greater than 10
        value = isNaN(value) ? 0 : value;

        if (value < 100) {
            value++;
            $("#product_qty").val(value);
        }
    });

    // decrement
    $("#decrement").click(function (e) {
        e.preventDefault();

        var product_qty = $("#product_qty").val();
        var value = parseInt(product_qty, 10); // check if is a number and not greater than 10
        value = isNaN(value) ? 0 : value;

        if (value > 1) {
            value--;
            $("#product_qty").val(value);
        }
    });
});
