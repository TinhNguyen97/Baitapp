$(document).ready(() => {
  for (let i = 0; i < 9; i++) {
    $("#container").append(`<div class='square' data-position="${i}"></div>`);
  }
  $(".square").css("cursor", "pointer");
  $("#container").css("width", "800px");
  $("#container").css("margin", "auto");
  $(".square").css("width", "12vw");
  $(".square").css("height", "12vw");
  $(".square").css("background-color", "yellow");
  $(".square").css("border", "1px solid");
  $(".square").css("float", "left");
  $(".square").css("text-align", "center");
  $(".square").css("font-size", "200px");
  $(".square").mouseover(function () {
    $(this).css("background-color", "green");
  });
  $(".square").mouseout(function () {
    $(this).css("background-color", "yellow");
  });
  $("#status").click(() => {
    $("#container").toggleClass("container-status");
    $("#container").hasClass("container-status")
      ? $("#status").text("Hiện")
      : $("#status").text("Ẩn");
  });
  var count = 0;
  $("#start").click(function () {
    $("#start").css("background-color", "green");
  });

  var position;
  var content = "";
  $(document).on("click", ".square", function () {
    // Add other DIV
    if (
      $(this).html() == "" &&
      $("#start").css("background-color") == "rgb(0, 128, 0)"
    ) {
      // $(this).html(content);
      position = $(this).data("position");
      count++;
      if (count % 2 == 1) {
        $(this).html("O");
      } else $(this).html("X");
    }
  });
  $(document).on("click", "#undo", function () {
    if ($(`[data-position=${position}]`).html()) {
      content = $(`[data-position=${position}]`).html();
      count--;
      //content = 'X' hoặc content = 'O'
    }
    $(`[data-position=${position}]`).html("");
  });

  $("#clear").click(function () {
    $("#start").css("background-color", "rgb(246, 164, 135)");
    $(".square").html("");
    count = 0;
  });
});
