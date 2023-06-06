var arr = [
  {
    stt: 1,
    name: "Nguyễn Văn A",
    sex: "Male",
    age: 18,
    email: "abc@gmail.com",
    address: "Hà Nội",
  },
  {
    stt: 2,
    name: "Nguyễn Văn B",
    sex: "Male",
    age: 20,
    email: "def@gmail.com",
    address: "Ninh Bình",
  },
  {
    stt: 3,
    name: "Nguyễn Thị C",
    sex: "Female",
    age: 18,
    email: "ghk@gmail.com",
    address: "Hồ Chí Minh",
  },
];
var content = "";
var stt = 1;
updateListTable();
$(document).ready(() => {
  $("#listTable").html(content);
  $("#formRegister").validate({
    onfocusout: false,
    onkeyup: false,
    onclick: false,
    rules: {
      name: {
        required: true,
      },
      sex: {
        required: true,
      },
      age: {
        required: true,
      },
    },
    messages: {
      name: {
        required: "Không được để trống tên",
      },
      sex: {
        required: "Không được để trống giới tính",
      },
      age: {
        required: "Không được để trống tuổi",
      },
      email: {
        email: "Email không đúng định dạng",
      },
    },
  });
  $("#formRegister").on("submit", function (e) {
    e.preventDefault();
    var name = $("#inputFullname").val();
    var sex = $("#inputSex option:selected").text();
    var age = $("#inputAge").val();
    var email = $("#inputEmail").val();
    var address = $("#inputAddress").val();

    if ($("#formRegister").valid()) {
      arr.push({
        stt: stt++,
        name: name,
        sex: sex,
        age: age,
        email: email,
        address: address,
      });
      updateListTable();
      swal({
        title: "Đăng ký thành công!",
        icon: "success",
        button: "OK!",
      });
    }
  });
});
function remove(i) {
  swal({
    title: "Bạn muốn xóa chứ?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      arr.splice(i, 1);

      updateListTable();
      $("#listTable").html(content);
      swal("Bạn đã xóa thành công!", {
        icon: "success",
      });
    } else {
      swal("Bạn hoàn tác thành công!");
    }
  });
}
function updateListTable() {
  content = "";
  stt = 1;
  arr.forEach((item, i) => {
    content += ` <tr><td>${stt++}</td>
    <td>${item.name}</td>
    <td>${item.sex}</td>
    <td>${item.age}</td>
    <td>${item.email}</td>
    <td>${item.address}</td>
    <td><button type="button" onclick="remove(${i})"><i class="bi bi-trash"></i></button></td>
    </tr>`;
  });
  $("#listTable").html(content);
}
