function removeMessageCreateError() {
    $("#name-error").css("display", "none");
    $("#image-error").css("display", "none");
    $("#unit_price-error").css("display", "none");
    $("#promotion_price-error").css("display", "none");
    $("#description-error").css("display", "none");
    $("#quantity-error").css("display", "none");
    $("#unit_price-error").css("display", "none");
}

$(document).ready(function () {
    $.validator.addMethod(
        "greaterThan",
        function (value, element, param) {
            var $otherElement = $(param);
            return parseInt(value, 10) >= parseInt($otherElement.val(), 10);
        },
        "Đơn giá phải lớn hơn giá khuyến mại."
    );

    $("#create-products")
        .parent()
        .validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,

            rules: {
                name: {
                    required: true,
                },
                unit_price: {
                    greaterThan: "#promotion_price",
                },
            },
            messages: {
                name: {
                    required: "Không được để trống tên.",
                    // minlength: "it nhất 2 ký tự"
                },
                image: {
                    required: "Không được để trống ảnh.",
                    // minlength: "it nhất 2 ký tự"
                },
                unit_price: {
                    required: "Không được để trống giá tiền.",
                },
                promotion_price: {
                    required: "Không được để trống giá khuyến mại.",
                },
                product_quantity: {
                    required: "Không được để trống số lượng.",
                },
                description: {
                    required: "Không được để trống mô tả sản phẩm.",
                },
            },
        });
    $("#form-edit").validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,

        rules: {
            name: {
                required: true,
            },
            editPrice: {
                greaterThan: "#editPromotionPrice",
            },
        },
        messages: {
            editName: {
                required: "Không được để trống tên.",
                // minlength: "it nhất 2 ký tự"
            },
            editPrice: {
                required: "Không được để trống giá tiền.",
            },
            editPromotionPrice: {
                required: "Không được để trống giá khuyến mại.",
            },
            editQuantity: {
                required: "Không được để trống số lượng.",
            },
            editDescr: {
                required: "Không được để trống mô tả sản phẩm.",
            },
            // image: {
            //     required: "Không được để trống ảnh."
            // }
        },
    });
});

function deleteDish(id) {
    $("#delete-category").parents("form").attr("action", routeDelete(id));
    // $('#delete-category').append('<input type="hidden" name="myfieldname"/>')
}

function showDetail(
    name,
    id,
    tp_name,
    image,
    promotion_price,
    quantity,
    description,
    unit_price,
    type_id,
    is_active
) {
    console.log($(this));
    $("#form-edit").attr("action", routeUpdate(id)).valid();
    $("#editName").val(name);
    $("#editType").val(type_id);
    $("#editPrice").val(unit_price);
    $("#editPromotionPrice").val(promotion_price);
    $("#editQuantity").val(quantity);
    $("#editDescr").val(description);
    $("#is_active").val(is_active);
    $("#editImage").attr(
        "src",
        $(this).parents("tr").find(".image").attr("src")
    );
}