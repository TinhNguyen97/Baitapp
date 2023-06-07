$(document).ready(function () {
  $("#demoForm").validate({
    onfocusout: false,
    onkeyup: false,
    onclick: false,
    rules: {
      email: {
        required: true,
      },
      password: {
        required: true,
        minlength: 8,
      },
    },
    messages: {
      email: {
        required: "Không được để trống email",
      },
      password: {
        required: "Không được để trống password",
        minlength: "Hãy nhập ít nhất 8 ký tự",
      },
    },
  });

  $("#demoForm").on("submit", function (e) {
    // xóa bỏ hành vi mặc định của form (action -> list.html)
    e.preventDefault();

    if ($("#demoForm").valid()) {
      var email = $("#typeEmailX-2").val();
      var password = $("#typePasswordX-2").val();
      if (email === "tinhnn.jvb@gmail.com" && password === "12345678") {
        window.location.href = "list.html";
      } else {
        $("#error").text("Tài khoản hoặc mật khẩu không đúng");
      }
    }
  });
  $("#logout").click(() => {
    window.location.href = "index.html?success=true";
  });
  var url = new URL(location.href);
  var c = url.searchParams.get("success");
  if (c) {
    swal({
      title: "Logout Succes!",
      icon: "success",
      button: "OK!",
    });
  }
  var originalURL = location.href;
  var alteredURL = removeParam("success", originalURL);
  history.pushState({}, "", alteredURL);
});

function removeParam(key, sourceURL) {
  var rtn = sourceURL?.split("?")[0],
    param,
    params_arr = [],
    queryString = sourceURL.indexOf("?") !== -1 ? sourceURL.split("?")[1] : "";
  if (queryString !== "") {
    params_arr = queryString.split("&");
    for (var i = params_arr.length - 1; i >= 0; i -= 1) {
      param = params_arr[i].split("=")[0];
      if (param === key) {
        params_arr.splice(i, 1);
      }
    }
    if (params_arr.length) rtn = rtn + "?" + params_arr.join("&");
  }
  return rtn;
}
