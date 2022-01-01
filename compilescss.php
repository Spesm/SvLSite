<?php

require __DIR__ . '/vendor/autoload.php';

use ScssPhp\ScssPhp\Compiler;

$compiler = new Compiler();
$compiler->setImportPaths('assets/');
$css = $compiler->compileString('@import "/assets/stylesheet.scss";')->getCss();

file_put_contents(__DIR__ . '/assets/stylesheet.css', $css);
