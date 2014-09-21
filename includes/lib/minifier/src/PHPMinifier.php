<?php
namespace Minifier;

/**
 * Minifier for PHP-Code
 *
 * @author Sönke Junike <soenke-junike@wsp-hanseatic.de>
 */
class PHPMinifier
extends AMinifier
{
	/**
	 * @see \Minifier\AMinifier::trimWhitespaceFromSpecialCharacters()
	 */
	protected function trimWhitespaceFromSpecialCharacters($code) {
		throw new \Exception("Not implemented yet");
	}
} // end of class PHPMinifier