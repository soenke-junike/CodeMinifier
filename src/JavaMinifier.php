<?php

namespace CodeMinifier;

/**
 * Minifier for Java-Code
 *
 * @author Sönke Junike <soenke-junike@wsp-hanseatic.de>
 */
class JavaMinifier
extends AMinifier
{
	/**
	 * @see \Minifier\AMinifier::trimWhitespaceFromSpecialCharacters()
	 */
	protected function trimWhitespaceFromSpecialCharacters($code) {
		throw new \Exception("Not implemented yet");
	}
} // end of class JavaMinifier