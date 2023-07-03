var id = window.location.search;
id = id.replace("?id=", "");

function showDetailDish() {
  $.ajax({
    type: "GET",
    url: `/bai-tap/web-sale/php/detail.php?id=${id}`,
    success: function (dish) {
      let content = "";
      content += ` <div class="col-lg-3 col-md-6 col-sm-6 animate-box">
      <a class="fh5co-card" href="#">
        <img
          src="/bai-tap/web-sale/php/${dish.image}"
          alt="Free HTML5 Bootstrap template"
          class="img-responsive"
        />
        <div class="fh5co-card-body" id="list">
          <h3 style="color: aquamarine">Sản phẩm: ${dish.name}</h3>
          <h3 style="font-size: 15px; font-style:italic">
            Giá: ${dish.price}
          </h3>
          <h3 style="font-size: 15px; font-style:italic">
          Danh mục: ${dish.category}
        </h3>
          <h3 style="font-size: 15px; font-style:italic">
            Mô tả: ${dish.desc}
          </h3>
          <h3 style="font-size: 15px; font-style:italic">
            Giảm giá: ${dish.discount}
          </h3>
        </div>
      </a>
    </div>
       `;

      $("#detail").append(content);
      contentWayPoint();
    },
  });
}
showDetailDish();
