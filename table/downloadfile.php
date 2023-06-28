<?php
function download($fileName)
{
  $fo = fopen($fileName, "rb");
  //thong bao cho trinh duyet biet la du lieu tra ve la dang nhi phan
  header("Content-Type: application/octet-stream");

  //thong bao dung luong file download
  header("Content-length" . filesize($fileName));

  //thong bao cho trinh duyet ten cua file va phai duoc cua download
  header("Content-Disposition: attachment;filename=" . $fileName);
  //doc noi dung cua file va tra ve cho trinh duyet xu ly
  fpassthru($fo);
  $fc = fclose($fo);
}

if (!empty($_GET['image'])) {
  download($_GET['image']);
}
