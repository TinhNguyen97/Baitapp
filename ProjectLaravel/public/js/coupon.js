function removeMessageCreateError() {
    document.getElementById("name-error").style.display = "none";
    document.getElementById("code-error").style.display = "none";
    document.getElementById("time-error").style.display = "none";
    document.getElementById("number-error").style.display = "none";
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
    // console.log($('#create-products').parent())
    $("#create-products")
        .parent()
        .validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,

            rules: {
                coupon_name: {
                    required: true,
                },
                code: {
                    required: true,
                },
                time: {
                    required: true,
                },
                number: {
                    required: true,
                },
            },
            messages: {
                coupon_name: {
                    required: "Không được để trống tên.",
                    // minlength: "it nhất 2 ký tự"
                },
                code: {
                    required: "Không được để trống mã.",
                    // minlength: "it nhất 2 ký tự"
                },
                time: {
                    required: "Không được để trống số lượng.",
                },
                number: {
                    required: "Không được để trống giảm giá.",
                },
            },
        });
    $("#form-edit").validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,

        rules: {
            editName: {
                required: true,
            },

            editCode: {
                required: true,
            },
            editTime: {
                required: true,
            },
            editNumber: {
                required: true,
            },
        },
        messages: {
            editName: {
                required: "Không được để trống tên.",
                // minlength: "it nhất 2 ký tự"
            },
            editCode: {
                required: "Không được để trống mã.",
                // minlength: "it nhất 2 ký tự"
            },
            editTime: {
                required: "Không được để trống số lượng.",
            },
            editNumber: {
                required: "Không được để trống giảm giá.",
            },
        },
    });
});

function deleteDish(code) {
    $("#delete-category").parents("form").attr("action", routeDelete(code));
    // $('#delete-category').append('<input type="hidden" name="myfieldname"/>')
}

function showDetail(name, id, code, time, number) {
    $("#form-edit").attr("action", routeUpdate(code)).valid();
    $("#editName").val(name);
    $("#editCode").val(code);
    $("#editTime").val(time);
    $("#editNumber").val(number);
}
