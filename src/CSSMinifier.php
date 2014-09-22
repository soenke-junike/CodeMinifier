<?php

namespace CodeMinifier;

/**
 * Minifier for CSS-Code
 * 
 * @author Sönke Junike <soenke-junike@wsp-hanseatic.de>
 */
class CSSMinifier
extends AMinifier
{
	/**
	 * @see \Minifier\AMinifier::trimWhitespaceFromSpecialCharacters()
	 */
	protected function trimWhitespaceFromSpecialCharacters($code) {
		return preg_replace("/\s*(,|:|;|\{|\})\s*/", "$1", $code);
	}
	
} // end of class CSSMinifier