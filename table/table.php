<?php
function getAge($birthDate)
{
  $birthDate = explode("-", $birthDate);
  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    ? ((date("Y") - $birthDate[2]) - 1)
    : (date("Y") - $birthDate[2]));
  return $age;
}


$arr = [
  ['STT' => 1, 'name' => 'Nguyễn Văn A', 'birth' => '12-02-2001', 'age' => getAge('12-02-2001'), 'mail' => 'abc@mgmail.com', 'image' => 'hazard.jpg'],
  ['STT' => 2, 'name' => 'Nguyễn Văn B', 'birth' => '03-09-1998', 'age' =>  getAge('03-09-1998'),  'mail' => 'def@mgmail.com', 'image' => 'messi.jpg'],
  ['STT' => 3, 'name' => 'Nguyễn Văn C', 'birth' => '06-07-2003', 'age' => getAge('06-07-2003'), 'mail' => 'ghi@mgmail.com', 'image' => 'ronaldo.jpg']
];
$stt = 1;

require 'downloadfile.php';
echo '<pre>';
if (isset($_POST['submit'])) {
  $uploadPath = '';
  $tmpFilePath = $_FILES['file']['tmp_name'];
  if ($tmpFilePath) {
    $uploadPath = $_FILES['file']['name'];
  }
  if (move_uploaded_file($tmpFilePath, $uploadPath)) {
    move_uploaded_file($tmpFilePath, $uploadPath);
  }
  if (isset($_POST['users'])) {
    $users = json_decode($_POST['users']);
    $arr = $users;
    foreach ($arr as &$item) {
      $item = (array) $item;
    }
  };

  $data = [
    'STT' => $stt,
    'name' => $_POST['name'],
    'birth' => $_POST['date'] == '' ?  '' : date("d-m-Y", strtotime($_POST['date'])),
    'age' => $_POST['age'],
    'mail' => $_POST['email'],
    'image' => $uploadPath
  ];

  $arr[] = $data;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
  <div>
    <table class="table table-striped" id="listTable">
      <thead>
        <tr>
          <th scope="col">STT</th>
          <th scope="col">Họ và tên</th>
          <th scope="col">Ngày/tháng/năm sinh</th>
          <th scope="col">Tuổi</th>
          <th scope="col">Mail</th>
          <th scope="col" colspan="2" style="text-align: center;">Ảnh</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($arr as $row) : ?>
          <tr>
            <th><?= $stt++; ?></th>
            <td><?= $row['name']; ?></td>
            <td><?= $row['birth']; ?></td>
            <td><?= $row['age']; ?></td>
            <td><?= $row['mail']; ?></td>
            <td><img src="<?= $row['image'] ?? '' ?>" width="120px" height="120px"></td>
            <td><a href="downloadfile.php?image=<?= $row['image'] ?? '' ?>">Download</a></td>

          </tr>

        <?php endforeach; ?>
        <form method="post" action="" enctype="multipart/form-data" id="form">
          <input type="hidden" name="users" id="input-users">
          <tr>
            <th><?= $stt ?></th>
            <td><input type="text" placeholder="Họ và tên" name="name"></td>
            <td><input type="date" id="date" placeholder="Ngày/tháng/năm sinh" onchange="getAge()" name="date" max="<?= date('Y-m-d'); ?>">
            </td>
            <td><input readonly id="age" name="age"></td>
            <td><input type="email" name="email"></td>
            <td><input id="img" type="file" name="file"></td>

            <td><button type="submit" name="submit" id="submit">Submit</button></td>
          </tr>
        </form>
      </tbody>
    </table>
  </div>
  <script>
    var users = JSON.parse(localStorage.getItem('arr'));
    var users2 = []

    function getAge() {
      var input = document.getElementById("date").value;
      const ageDifMs = Date.now() - new Date(input).getTime();
      const ageDate = new Date(ageDifMs);
      document.getElementById("age").value = Math.abs(ageDate.getUTCFullYear() - 1970);
    }
    $(function() {
      $('#form').on('submit', function(e) {
        const pop = users2.pop()
        const users2Encode = JSON.stringify(users2);

        $('#input-users').val(users2Encode);

      })
    })
    $('#listTable tbody tr').each(function() {
      var name = $(this).children()[1].innerText;
      var birth = $(this).children()[2].innerText;
      var age = $(this).children()[3].innerText;
      var mail = $(this).children()[4].innerText;
      var image = $($(this).children()[5]).children('img').attr('src');
      var down = $($(this).children()[6]).children('a').attr('href');
      users2.push({
        name,
        birth,
        age,
        mail,
        image,
        down
      })
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>

</html>