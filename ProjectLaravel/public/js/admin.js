var link = location.href;
if (link.includes("products")) {
    $("#nav-link-products").addClass("active");
}
if (link.includes("types")) {
    $("#nav-link-type-products").addClass("active");
}
if (link.includes("orders")) {
    $("#list-link").addClass("active menu-is-opening menu-open");
    $("#nav-link-order").addClass("active");
    $("#link-order").addClass("css-active");
}
if (link.includes("history") || link.includes("searchhistory")) {
    $("#link-history").addClass("css-active");
    $("#link-order").removeClass("css-active");
    $("link-cancel").removeClass("css-active");
}
if (link.includes("ordercancel") || link.includes("searchordercancel")) {
    $("#link-cancel").addClass("css-active");
    $("#link-order").removeClass("css-active");
    $("#link-history").removeClass("css-active");
}
if (link.includes("users")) {
    $("#nav-link-users").addClass("active");
}
if (link.includes("infors")) {
    $("#nav-link-info").addClass("active");
}
if (link.includes("coupons")) {
    $("#nav-link-coupon").addClass("active");
}
if (link.includes("statisticals")) {
    $("#nav-link-statistical").addClass("active");
}
function imagePreview(input, form, idError) {
    let error = document.querySelector(idError);
    let isValid = false;
    let $form = $(form);
    $form.off("submit");
    error.innerHTML = "";

    if (input.files) {
        let file = input.files[0];
        if (file.size > 1024 * 1024 * 2) {
            error.innerHTML = "Vui lòng chọn file ảnh nhỏ hơn 2 MB";
            isValid = true;
        }
        let allowedImageTypes = ["image/jpeg", "image/gif", "image/png"];
        if (!allowedImageTypes.includes(file.type)) {
            error.innerHTML =
                "Vui lòng chọn file ảnh có định dạng [ .jpg .png .gif ]";
            isValid = true;
        }
        $form.on("submit", (e) => {
            $form.valid();
            if (isValid) {
                e.preventDefault();
            }
        });
    }
}
