function topSale() {
  $.ajax({
    type: "GET",
    url: "/bai-tap/web-sale/php/topsale.php",
    success: function (dish) {
      let content = "";
      if (dish.length === 0) {
        content +=
          '                <div class="col-md-12 text-center pt-5 pb-5">\n' +
          '                    <img class="img-fluid" src="../../img/404.png" alt="404">\n' +
          '                    <h1 class="mt-2 mb-2">Không tìm thấy</h1>\n' +
          "                    <p>Uh-oh! Nội dung bạn tìm kiếm <br>không tồn tại. Mời bạn thử lại.</p>\n" +
          '                    <a class="btn btn-primary btn-lg" href="/Module-4-FE/pages/category/category.html">Quay lại</a>\n' +
          "                </div>";

        $("#list").hide();
        $("#error-404").html(content);
      } else {
        for (let i = 0; i < dish.length; i++) {
          content += ` 
          <div class="col-lg-3 col-md-6 col-sm-6 animate-box">
              <a class="fh5co-card" href="/bai-tap/web-sale/php/detail.html?id=${dish[i].id}">
                <img
                  src="/bai-tap/web-sale/php/${dish[i].image}"
                  alt="Free HTML5 Bootstrap template"
                  class="img-responsive"
                />
                <div class="fh5co-card-body" id="list">
                  <h3 style="color: aquamarine">Sản phẩm: ${dish[i].name}</h3>
                  <h3  style="font-size: 15px; font-style:italic">
                    Giá: ${dish[i].price}
                  </h3>
                  <h3  style="font-size: 15px; font-style:italic">
                  Danh mục: ${dish[i].category}
                </h3>
                  <h3  style="font-size: 15px; font-style:italic">
                    Mô tả: ${dish[i].desc}
                  </h3>
                  <h3  style="font-size: 15px; font-style:italic">Khuyến mại: 
                    ${dish[i].discount}
                  </h3>
                </div>
              </a>
            </div>
           `;
        }
        // console.log(content);
        $("#list").append(content);
        contentWayPoint();
      }
    },
  });
  // event.preventDefault();
}
function getAllDish() {
  $.ajax({
    type: "GET",
    url: "/bai-tap/web-sale/php/findAllDb.php",
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
          content += ` <div class="col-lg-3 col-md-6 col-sm-6 animate-box">
          <a class="fh5co-card" href="/bai-tap/web-sale/php/detail.html?id=${dish[i].id}">
            <img
              src="/bai-tap/web-sale/php/${dish[i].image}"
              alt="Free HTML5 Bootstrap template" style="width: 430px; height: 500px;"
              class="img-responsive"
            />
            <div class="fh5co-card-body" id="list">
              <h3 style="color: aquamarine">Sản phẩm: ${dish[i].name}</h3>
              <h3 style="font-size: 15px; font-style:italic">
                Giá: ${dish[i].price}
              </h3>
              <h3 style="font-size: 15px; font-style:italic">
              Danh mục: ${dish[i].category}
            </h3>
              <h3 style="font-size: 15px; font-style:italic">
                Mô tả: ${dish[i].desc}
              </h3>
              <h3 style="font-size: 15px; font-style:italic">Khuyến mại: 
              ${dish[i].discount}
            </h3>
            </div>
          </a>
        </div>
           `;
        }
        $("#list2").html(content);
        contentWayPoint();
      }
    },
  });
  // event.preventDefault();
}
function getNewest() {
  $.ajax({
    type: "GET",
    url: "/bai-tap/web-sale/php/newest.php",
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
          content += ` <div class="col-lg-3 col-md-6 col-sm-6 animate-box">
          <a class="fh5co-card" href="/bai-tap/web-sale/php/detail.html?id=${dish[i].id}">
            <img
              src="/bai-tap/web-sale/php/${dish[i].image}"
              alt="Free HTML5 Bootstrap template" style="width: 430px; height: 500px;"
              class="img-responsive"
            />
            <div class="fh5co-card-body" id="list">
              <h3 style="color: aquamarine">Sản phẩm: ${dish[i].name}</h3>
              <h3 style="font-size: 15px; font-style:italic">
                Giá: ${dish[i].price}
              </h3>
              <h3 style="font-size: 15px; font-style:italic">
              Danh mục: ${dish[i].category}
            </h3>
              <h3 style="font-size: 15px; font-style:italic">
                Mô tả: ${dish[i].desc}
              </h3>
              <h3 style="font-size: 15px; font-style:italic">Khuyến mại: 
              ${dish[i].discount}
            </h3>
            </div>
          </a>
        </div>
           `;
        }
        $("#list3").html(content);
        contentWayPoint();
      }
    },
  });
  // event.preventDefault();
}
function getDiscount() {
  $.ajax({
    type: "GET",
    url: "/bai-tap/web-sale/php/newest.php",
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
          content += ` <div class="col-lg-3 col-md-6 col-sm-6 animate-box">
          <a class="fh5co-card" href="/bai-tap/web-sale/php/detail.html?id=${dish[i].id}">
            <img
              src="/bai-tap/web-sale/php/${dish[i].image}"
              alt="Free HTML5 Bootstrap template" style="width: 430px; height: 500px;"
              class="img-responsive"
            />
            <div class="fh5co-card-body" id="list">
              <h3 style="color: aquamarine">Sản phẩm: ${dish[i].name}</h3>
              <h3 style="font-size: 15px; font-style:italic">
                Giá: ${dish[i].price}
              </h3>
              <h3 style="font-size: 15px; font-style:italic">
              Danh mục: ${dish[i].category}
            </h3>
              <h3 style="font-size: 15px; font-style:italic">
                Mô tả: ${dish[i].desc}
              </h3>
              <h3 style="font-size: 15px; font-style:italic">Khuyến mại: 
              ${dish[i].discount}
            </h3>
            </div>
          </a>
        </div>
           `;
        }
        $("#list4").html(content);
        contentWayPoint();
      }
    },
  });
  // event.preventDefault();
}
topSale();
getAllDish();
getNewest();
getDiscount();
