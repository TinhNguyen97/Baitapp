function updateTotalPay(key) {
    var index = this.value.length - 1;
    if (isNaN(Number(this.value[index]))) {
        this.value = this.value?.slice(0, -1);
        // console.log(this.value);
    }
    if (this.value == 0) {
        this.value = 1;
    }
    if (this.value[0] == 0 && this.value.length > 1) {
        this.value = this.value?.slice(1);
    }
    // $(this).parents('tr').find('.product-subtotal').text(123)
    // return;
    var totalPrice = 0;
    var totalQty = 0;
    var quantity = $(this).val();
    var oldPrice = $(this).data("price");
    var coupon = $("#coupon").text().replace("%", "");
    $(this)
        .parents("tr")
        .find(".product-subtotal")
        .text(formatNumberWithDot(quantity * oldPrice));
    $(this)
        .parents("tbody")
        .find(".product-subtotal")
        .each((index, item) => {
            totalPrice += Number($(item).text().trim().replaceAll(".", ""));
        });

    $(".product-qty")
        .parents("tbody")
        .find(".product-quantity .product-qty")
        .each((index, item) => {
            totalQty += Number($(item).val().trim().replaceAll(".", ""));
        });

    $("#total-quantity").text(totalQty);
    $("#total-price").text(" " + formatNumberWithDot(totalPrice) + " VNĐ");
    $("#total-after-cou").text(
        " " + formatNumberWithDot(totalPrice * (1 - coupon / 100)) + " VNĐ"
    );

    $.ajax({
        url: "{{ route('homes.updatecart', [' a', ' b']) }}"
            .replace("%20a", key)
            .replace("%20b", quantity),
        type: "POST",
        data: {},
        success: function () {
            // console.log("Data sent!");
        },
    });
}
