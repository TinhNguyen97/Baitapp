<?php
include 'result.php';
define ('x', 2);
define ('y',3);
function area ($x, $y) {
  return $x*$y;
};
function perimeter ($x, $y) {
  return ($x+$y)*2;
}
// $area = ;
// $perimeter = show(perimeter(2,3));
show('Diện tích của hình chữ nhật là: '.area(x,y)."\n");
show( 'Chu vi của hình chữ nhật là: '.perimeter(x,y));
?>
