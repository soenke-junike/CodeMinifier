<?php

use Minifier\CSSMinifier;
// Path to Minifier
require __DIR__."/../minifier.inc.php";

$css = <<<EOT
body   ,   div
{
	property: value;
	/*
		Multiline-Comment
	*/
	property1: "value1";
	property2    : "value2"   ; // single Line comment
}
EOT;

$cssMinifier = new CSSMinifier();
echo $cssMinifier->getMinifiedCode($css);