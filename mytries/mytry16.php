<?php
// classa.inc:
  class A {
      var $one = 1;

      function show_one() {
          echo $this->one;
      }
  }

// page1.php:
  include("classa.inc");

  $a = new A;
  $s = serialize($a);
  // 将 $s 存放在某处使 page2.php 能够找到
  $fp = fopen("store", "w");
  fwrite($fp, $s);
  fclose($fp);

// page2.php:
  // 为了正常解序列化需要这一行
  include("classa.inc");

  $s = implode("", @file("store"));
  $a = unserialize($s);

  // 现在可以用 $a 对象的 show_one() 函数了
  $a->show_one();
?> 