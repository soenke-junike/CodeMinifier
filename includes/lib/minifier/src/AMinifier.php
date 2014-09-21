<?php
namespace Minifier;

/**
 * brief description of class AMinifier
 * 
 * detailed description
 *
 * @author Sönke Junike <Sönke-Junike@design-junike.de>
 */
class AMinifier
{
	
	/** Name of $code with getter/setter Code and of type string
	 * The Code as a String
	 * detailed description (Typsicherheit und Wertebereich durch Getter/Setter herstellen?)
	 *
	 * @var string
	 */
	private $code;
	
	abstract protected function trimWhitespaceFromSpecialCharacters($code);
	
	
	/**
	 * brief description for method __construct
	 *
	 * @param param_type $nameOfParam description
	 * @return return_type
	 * @throws NameOfClass condition
	 */
	public function __construct($code) {
		$this->setCode($code);
	} // end of member function __construct
	
	/**
	 * brief description for method minify
	 *
	 * @param param_type $nameOfParam description
	 * @return return_type
	 * @throws NameOfClass condition
	 */
	public function getMinifiedCode() {
		$code = $this->getCode();
		
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
		
		$code = $this->trimWhitespaceForSpecialCharacters($code);
		
		//Laufe über alle zuvor gespeicherten Matches, Ersetze NAME-INDEX durch match,
		$delimiter = array("SINGLEQUOTES" => "'","DOUBLEQUOTES" => "\"",/*,"REGEXP" => "/"*/);
		foreach ($delimiter as $name => $d) {
			$i=0;
			foreach ($matches["$name"][0] as $match) {
				$i++;
				$code = str_ireplace("$d###$name-$i###$d", $match, $code);
			}
		}
		/* Done Strip Single Line Comments */
	} // end of member function minify
	
	/**
	 * Auto-generated getter for variable $code
	 *
	 * @return string
	 */
	private function getCode( ) {
		return $this->code;
	} // end of member function getCode
	
	/**
	 * Auto-generated setter for variable $code
	 *
	 * @param string $code The Code as a String
	 */
	private function setCode( string $code ) {
		$this->code = $code;
	} // end of member function setCode
	
} // end of class AMinifier