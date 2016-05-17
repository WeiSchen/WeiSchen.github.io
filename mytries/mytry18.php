<?php
try {
    $error = 'Always throw this error<br />';
    throw new Exception($error);

    // 从这里开始，tra 代码块内的代码将不会被执行
    echo 'Never executed<br />';

} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "<br />\n";
}

// 继续执行
echo 'Hello World<br />';
?> 