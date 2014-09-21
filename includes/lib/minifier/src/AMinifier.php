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

	abstract protected function trimWhitespaceFromSpecialCharacters($code);
	
	/**
	 * brief description for method minify
	 *
	 * @param param_type $nameOfParam description
	 * @return return_type
	 * @throws NameOfClass condition
	 */
	public function getMinifiedCode($code) {
		
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
		
		// Erseze alle einzeiligen Kommentare
		$code = preg_replace("@[^\\\]//.*$@m","",$code); //@todo wenn ich richtig sehe unterscheidet sich der CSS-Minifier im Moment nur vom JS-Minifier durch [^\\\]
		
		
		//remove all Linebreaks
		$code = preg_replace("/\n/", "", $code);
		
		
		// Strip multi-line comments
		$code = preg_replace("@/\*(([^/]+)|(?<!\*)/)+\*/@", "", $code); //
		
		// Remove all multiple whitespaces by a single one
		$code = preg_replace("/\s+/", " ", $code);
		
		$code = $this->trimWhitespaceFromSpecialCharacters($code);
		
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
		/* Done Strip Single Line Comments */
	} // end of member function minify
		
} // end of class AMinifier