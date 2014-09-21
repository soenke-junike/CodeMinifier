<?php
namespace Minifier;

/**
 * brief description of class AMinifier
 * 
 * detailed description
 *
 * @author Sönke Junike <Sönke-Junike@design-junike.de>
 */
abstract class AMinifier
{

	/**
	 * Replaces Whitepace before and after special Characters in $code
	 * 
	 * @param string $code
	 * @return string $code
	 */
	abstract protected function trimWhitespaceFromSpecialCharacters($code);
	
	/**
	 * brief description for method minify
	 *
	 * @param param_type $nameOfParam description
	 * @return return_type
	 * @throws NameOfClass condition
	 */
	public function getMinifiedCode($code) {
		
		$code = $this->replaceStringsByConstants($code);
		
		$code = $this->replaceSingleLineComments_MultiLineComments_LineBreaks_DoubleWhitespace($code);
		
		$code = $this->trimWhitespaceFromSpecialCharacters($code);
		
		$code = $this->replaceConstantsByString($code);
		
		return $code;
		/* Done Strip Single Line Comments */
	} // end of member function minify

	/**
	 * brief description for method ReplaceStringsByConstants
	 * This function has to be edited together with replaceConstantsByString. Make sure the the delimiter is in switched order!
	 *
	 * @param param_type $nameOfParam description
	 * @return return_type
	 * @throws NameOfClass condition
	 */
	private function replaceStringsByConstants($code) {
		$matches = array();
		/* Strip Single Line Comments */
		$delimiter = array("DOUBLEQUOTES" => "\"","SINGLEQUOTES" => "'");
		//Laufe über Delimiter, speichere Matches in einem Array, Ersetze Matches durch NAME-INDEX,
		foreach ($delimiter as $name => $d) {
			if (is_int($name)) { echo "Variable \$name darf keine Zahl sein!\n"; exit; }
			preg_match_all("@$d.*?$d@",$code,$matches[$name]);
			$i=0;
			foreach ($matches[$name][0] as $match) {
				$i++;
				$code = str_ireplace($match, "$d###$name-$i###$d", $code);
			}
		}
		
		$this->setTempMatchesForStrings($matches);
		
		return $code;
	} // end of member function replaceStringsByConstants
	
	/**
	 * brief description for method replaceConstantsByString
	 * This function has to be edited together with replaceStringsByConstants. Make sure the the delimiter is in switched order!
	 * 
	 * @param param_type $nameOfParam description
	 * @return return_type
	 * @throws NameOfClass condition
	 */
	private function replaceConstantsByString($code) {
		$matches = $this->getTempMatchesForStrings();
		//Laufe über alle zuvor gespeicherten Matches, Ersetze NAME-INDEX durch match,
		$delimiter = array("SINGLEQUOTES" => "'","DOUBLEQUOTES" => "\"",/*,"REGEXP" => "/"*/);
		foreach ($delimiter as $name => $d) {
			$i=0;
			foreach ($matches["$name"][0] as $match) {
				$i++;
				$code = str_ireplace("$d###$name-$i###$d", $match, $code);
			}
		}
		
		return $code;
	} // end of member function replaceConstantsByString
	
	/**
	 * brief description for method replaceSingleLineComments_MultiLineComments_LineBreaks_DoubleWhitespace
	 *
	 * @param param_type $nameOfParam description
	 * @return return_type
	 * @throws NameOfClass condition
	 */
	private function replaceSingleLineComments_MultiLineComments_LineBreaks_DoubleWhitespace($code) {
		// Erseze alle einzeiligen Kommentare
		$code = preg_replace("@[^\\\]//.*$@m","",$code); //@todo wenn ich richtig sehe unterscheidet sich der CSS-Minifier im Moment nur vom JS-Minifier durch [^\\\]
		
		
		//remove all Linebreaks
		$code = preg_replace("/\n/", "", $code);
		
		// Strip multi-line comments
		$code = preg_replace("@/\*(([^/]+)|(?<!\*)/)+\*/@", "", $code); //
		
		// Remove all multiple whitespaces by a single one
		$code = preg_replace("/\s+/", " ", $code);
		
		return $code;
	} // end of member function replaceSingleLineComments_MultiLineComments_LineBreaks_DoubleWhitespace
	
	
	/** Name of $tempMatchesForStrings with getter/setter TempMatchesForStrings and of type array
	 * briefVariableDescription
	 * detailed description (Typsicherheit und Wertebereich durch Getter/Setter herstellen?)
	 *
	 * @var array
	 */
	private $tempMatchesForStrings;
	
	/**
	 * Auto-generated getter for variable $tempMatchesForStrings
	 *
	 * @return array
	 */
	private function getTempMatchesForStrings( ) {
		return $this->tempMatchesForStrings;
	} // end of member function getTempMatchesForStrings
	
	/**
	 * Auto-generated setter for variable $tempMatchesForStrings
	 *
	 * @param array $tempMatchesForStrings briefVariableDescription
	 */
	private function setTempMatchesForStrings( array $tempMatchesForStrings ) {
		$this->tempMatchesForStrings = $tempMatchesForStrings;
	} // end of member function setTempMatchesForStrings
} // end of class AMinifier