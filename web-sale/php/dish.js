function getAllDish() {
  $.ajax({
    type: "GET",
    url: "/bai-tap/web-sale/php/findalldb.php",
    success: function (dish) {
      let content = ``;
      if (dish.length === 0) {
        content =
          '                <div class="col-md-12 text-center pt-5 pb-5">\n' +
          '                    <img class="img-fluid" src="../../img/404.png" alt="404">\n' +
          '                    <h1 class="mt-2 mb-2">Không tìm thấy</h1>\n' +
          "                    <p>Uh-oh! Nội dung bạn tìm kiếm <br>không tồn tại. Mời bạn thử lại.</p>\n" +
          '                    <a class="btn btn-primary btn-lg" href="/Module-4-FE/pages/category/category.html">Quay lại</a>\n' +
          "                </div>";

        $("#table_category").hide();
        $("#error-404").html(content);
      } else {
        for (let i = 0; i < dish.length; i++) {
          content += `  
        <tr>
        <td>${i + 1}</td>
        <td>${dish[i].name}</td>
        <td>${dish[i].category}</td>
        <td><img src="${dish[i].image}"
        height="140px" width="150px"></td>
        <td>${dish[i].price}</td>
        <td>${dish[i].discount}</td>
        <td>${dish[i].create_date}</td>
        <td><button class="btn btn-primary" data-target="#edit-category" data-toggle="modal"
                                        type="button" onclick="showEditDish(${
                                          dish[i].id
                                        })"><i class="fa fa-edit"></i></button></td>
        <td><button class="btn btn-danger" data-target="#delete-category" data-toggle="modal"
                                        type="button" onclick="showDeleteCategory(${
                                          dish[i].id
                                        })"><i class="fa fa-trash"></i></button></td>
        </tr>`;
        }
        $("#tableCategory").html(content);
      }
    },
  });
  // event.preventDefault();
}
function getAllCategory() {
  $.ajax({
    type: "GET",
    url: "/bai-tap/web-sale/php/findAllCategory.php",
    success: function (category) {
      var content = "";

      if (category.length > 0) {
        for (let i = 0; i < category.length; i++) {
          content += `<option value="${category[i].id}">${category[i].name}</option>`;
        }
      }
      $("select#category").append(content);
      $("#editCategory").append(content);
    },
  });
  // event.preventDefault();
}
getAllDish();
getAllCategory();
var dish = [];

function showDeleteCategory(id) {
  let content = `<button class="btn btn-secondary" data-dismiss="modal" type="button">Đóng</button>
  <form
  action="/bai-tap/web-sale/php/delete.php?id=${id}"
  method="post"><button class="btn btn-danger" type="submit" class="close">Xóa</button></form>`;
  $("#delete-category-button").html(content);
}

function createNewProduct() {
  let name = $("#name").val();
  let category = $("#category").val();
  let image = $("#image");
  let price = $("#price");
  let discount = $("#discount");
  let data = new FormData();
  data.append("image", image.prop("files")[0]);
  data.append("name", name);
  data.append("category", category);
  data.append("price", price);
  data.append("discount", discount);
  // $.ajax({
  //   type: "POST",
  //   url: "/bai-tap/web-sale/php/create.php",
  //   data: data,
  //   enctype: "multipart/form-data",
  //   processData: false,
  //   contentType: false,
  //   success: function (data) {
  //     getAllDish();
  //     showSuccessMessage("Tạo thành công!");
  //   },
  //   error: function () {
  //     showErrorMessage("Tạo lỗi");
  //   },
  // });
}

function showEditDish(id) {
  let content = `<button class="btn btn-secondary" data-dismiss="modal" type="button">Đóng</button>
  <button class="btn btn-primary" type="submit" class="close" name="update">Chỉnh sửa</button>`;
  $("#edit-form").html(content);
  $("#idEdit").val(id);
  $.ajax({
    type: "GET",
    url: `/bai-tap/web-sale/php/detail.php?id=${id}`,
    success: function (dish) {
      $("#editName").val(dish.name);
      $("#editPrice").val(dish.price);
      var image = document.getElementById("editImage");

      image.setAttribute("src", dish.image);

      $("#editCategory").val(dish.category_id);
    },
  });
}
