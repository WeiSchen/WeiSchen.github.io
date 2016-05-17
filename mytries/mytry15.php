<?php
class A {
    function example() {
        echo "I am the original function A::example().<br />\n";
    }
}

class B extends A {
    function example() {
        echo "I am the redefined function B::example().<br />\n";
        A::example();
    }
}

// A 类没有对象，这将输出
//   I am the original function A::example().<br />
A::example();

// B 类没有对象，这将输出
//   I am the redefined function B::example().<br />
//   I am the original function A::example().<br />
B::example();

// 建立一个 B 类的对象
$b = new B;

// 这将输出
//   I am the redefined function B::example().<br />
//   I am the original function A::example().<br />
$b->example();
?> 