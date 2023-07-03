$.ajax({
  url: "http://localhost:8080/testmysqlpdo/connectdb.php",
  type: "GET",
  success: function (res) {
    console.log(JSON.parse(res));
  },
});
