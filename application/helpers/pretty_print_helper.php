<?php

function pp($var) {
    echo highlight_string("<?php\n\$data =\n" . var_export($var, true) . ";\n?>");
}