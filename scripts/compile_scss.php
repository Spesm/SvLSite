<?php

require 'vendor/autoload.php';

use ScssPhp\ScssPhp\Compiler;

$compiler = new Compiler();
$compiler->setImportPaths('../assets/');
$css = $compiler->compileString('@import "stylesheet.scss";')->getCss();

file_put_contents('../assets/stylesheet.css', $css);
