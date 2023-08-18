<?php

function remove_special_character($string)
{

  $t = $string;

  $specChars = array(
    ' ' => '-',    '!' => '',    '"' => '',
    '#' => '',    '$' => '',    '%' => '',
    '&' => '',    '\'' => '',   '(' => '',
    ')' => '',    '*' => '',    '+' => '',
    ',' => '',    '₹' => '',    '.' => '',
    '/-' => '',    ':' => '',    ';' => '',
    '<' => '',    '=' => '',    '>' => '',
    '?' => '',    '@' => '',    '[' => '',
    '\\' => '',   ']' => '',    '^' => '',
    '_' => '',    '`' => '',    '{' => '',
    '|' => '',    '}' => '',    '~' => '',
    '-----' => '-',    '----' => '-',    '---' => '-',
    '/' => '',    '--' => '-',   '/_' => '-',

  );

  foreach ($specChars as $k => $v) {
    $t = str_replace($k, $v, $t);
  }

  return $t;
}
function checkRoute($name = '')
{
  return request()->route()->getName() == $name ? 'active menu-is-opening menu-open' : '';
}
function formatMoney($money)
{
  return number_format($money, 0, ',', '.');
}
