<?php
/**
 *	Rewrite of filter_var package for purposes of back porting to php < 5.2
 *
 *  Older versions of php don't include the filter_var package. If your software
 *  depends on this package this can be a hassle to work around. This package
 *  is meant as a drop in replacement for the filter_var package.
 * 
 *  @package filter_var
 *  @version 0.0.0
 *  @auther Zac Konopa <zac@javazac.com>
 */
define('INPUT_POST', 0); 						//POST variables
define('INPUT_GET', 1); 						//GET variables
define('INPUT_COOKIE', 2); 						//COOKIE variables
define('INPUT_ENV', 4); 						//ENV variables
define('INPUT_SERVER', 5);						//SERVER variables
define('INPUT_SESSION', 6);						//SESSION variables (not implemented yet)
define('INPUT_REQUEST', 99);					//REQUEST variables (not implemented yet)
define('FILTER_FLAG_NONE', 0);					//No flags.
define('FILTER_REQUIRE_SCALAR', 33554432);		//Flag used to require scalar as input.
define('FILTER_REQUIRE_ARRAY', 16777216);		//Require an array as input.
define('FILTER_FORCE_ARRAY', 67108864);			//Always returns an array.
define('FILTER_NULL_ON_FAILURE', 134217728);	//Use NULL instead of FALSE on failure.
define('FILTER_VALIDATE_INT', 257);				//ID of "int" filter.
define('FILTER_VALIDATE_BOOLEAN', 258);			//ID of "boolean" filter.
define('FILTER_VALIDATE_FLOAT', 259);			//ID of "float" filter.
define('FILTER_VALIDATE_REGEXP', 272);			//ID of "validate_regexp" filter.
define('FILTER_VALIDATE_URL', 273);				//ID of "validate_url" filter.
define('FILTER_VALIDATE_EMAIL', 274);			//ID of "validate_email" filter.
define('FILTER_VALIDATE_IP', 275);				//ID of "validate_id" filter.
define('FILTER_DEFAULT', 516);					//ID of default ("string") filter.
define('FILTER_UNSAFE_RAW', 516);				//ID of "unsafe_raw" filter.
define('FILTER_SANITIZE_STRING', 513);			//ID of "string" filter.
define('FILTER_SANITIZE_STRIPPED', 513);		//ID of "stripped" filter.
define('FILTER_SANITIZE_ENCODED', 514);			//ID of "encoded" filter.
define('FILTER_SANITIZE_SPECIAL_CHARS', 515);	//ID of "special_chars" filter.
define('FILTER_SANITIZE_EMAIL', 517);			//ID of "email" filter.
define('FILTER_SANITIZE_URL', 518);				//ID of "url" filter.
define('FILTER_SANITIZE_NUMBER_INT', 519);		//ID of "number_int" filter.
define('FILTER_SANITIZE_NUMBER_FLOAT', 520);	//ID of "number_float" filter.
define('FILTER_SANITIZE_MAGIC_QUOTES', 521);	//ID of "magic_quotes" filter.
define('FILTER_CALLBACK', 1024);				//ID of "callback" filter.
define('FILTER_FLAG_ALLOW_OCTAL', 1);			//Allow octal notation (0[0-7]+) in "int" filter.
define('FILTER_FLAG_ALLOW_HEX', 2);				//Allow hex notation (0x[0-9a-fA-F]+) in "int" filter. 
define('FILTER_FLAG_STRIP_LOW', 4);				//Strip characters with ASCII value less than 32.
define('FILTER_FLAG_STRIP_HIGH', 8);			//Strip characters with ASCII value greater than 127. 
define('FILTER_FLAG_ENCODE_LOW', 16);			//Encode characters with ASCII value less than 32.
define('FILTER_FLAG_ENCODE_HIGH', 32);			//Encode characters with ASCII value greater than 127.
define('FILTER_FLAG_ENCODE_AMP', 64);			//Encode &. 
define('FILTER_FLAG_NO_ENCODE_QUOTES', 128);	//Don't encode ' and ". 
define('FILTER_FLAG_EMPTY_STRING_NULL', 256);	//(No use for now.)
define('FILTER_FLAG_ALLOW_FRACTION', 4096);		//Allow fractional part in "number_float" filter. 
define('FILTER_FLAG_ALLOW_THOUSAND', 8192);		//Allow thousand separator (,) in "number_float" filter. 
define('FILTER_FLAG_ALLOW_SCIENTIFIC', 16384);	//Allow scientific notation (e, E) in "number_float" filter. 
define('FILTER_FLAG_PATH_REQUIRED', 262144);	//Require path in "validate_url" filter. 
define('FILTER_FLAG_QUERY_REQUIRED', 524288);	//Require query in "validate_url" filter. 
define('FILTER_FLAG_IPV4', 1048576);			//Allow only IPv4 address in "validate_ip" filter. 
define('FILTER_FLAG_IPV6', 2097152);			//Allow only IPv6 address in "validate_ip" filter. 
define('FILTER_FLAG_NO_RES_RANGE', 4194304);	//Deny reserved addresses in "validate_ip" filter. 
define('FILTER_FLAG_NO_PRIV_RANGE', 8388608);	//Deny private addresses in "validate_ip" filter. 

define('_FILTER_EMAIL_REGEX', '/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/');	//Regex constant for validating email addresses.
define('_FILTER_FLOAT_REGEX', '/^-?\d*?\.?\d*?$/');	//Regex constant for validate floats w/o thousands seperator.
define('_FILTER_INT_BASE10_REGEX', '/^-?[1-9][0-9]*$/');	//Regex constant for validating base 10 integers.
define('_FILTER_INT_OCTAL_REGEX', '/^0[0-7]+$/');	//Regex constant for validating octal integers.
define('_FILTER_INT_HEX_REGEX', '/^0[x][0-9a-f]+$/i');	//Regex constant for validating hexidecimal integers.
define('_FILTER_IPV4_REGEX', '@^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$@');	//Regex constant for validateing IPv4 addresses.
define('_FILTER_IPV6_REGEX', '/^(((?=(?>.*?(::))(?!.+\3)))\3?|([\dA-F]{1,4}(\3|:(?!$)|$)|\2))(?4){5}((?4){2}|(25[0-5]|(2[0-4]|1\d|[1-9])?\d)(\.(?7)){3})\z/i');	//Regex constant for validateing IPv6 addresses.
define('_FILTER_VALIDATE_URL_SECTIONS_REGEX', '@^(([^:/?#]+):)?(//([^/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?'); //Regex constant used to break URLs into sections for further validation.
define('_FILTER_SANITIZE_EMAIL_REGEX', "@[^a-z!#$%&'*+-/=?^_`{|}~\@.\[\]]@"); //used to sanitize characters in an email address.
define('_FILTER_SANITIZE_NUMBER_FLOAT_REGEX1', '/[^\d-+\.,eE]/'); //filter all the absolutely disallowed characters

/**
 * Checks if varialbe of specified type exists
 * 
 * @param int $type One of INPUT_GET, INPUT_POST, INPUT_COOKIE, INPUT_SERVER, or INPUT_ENV.
 * @param string $variable_name Name of a variable to check.
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function filter_has_var($type, $variable_name)
{
	switch($type) {

		case INPUT_GET:
			return array_key_exists($variable_name, $_GET);

		case INPUT_POST:
			return array_key_exists($variable_name, $_POST);

		case INPUT_COOKIE:
			return array_key_exists($variable_name, $_COOKIE);

		case INPUT_SERVER:
			return array_key_exists($variable_name, $_SERVER);

		case INPUT_ENV:
			return array_key_exists($variable_name, $_ENV);

	}//end switch

	return false;

}//end function filter_has_var

/**
 * Returns the filter ID belonging to a named filter
 *
 * @param string $filtername The name of a filter to get the id for
 * @return mixed Integer ID of the filter or false if the filter doesn't exist.
 */
function filter_id($filtername)
{
	switch($filtername) {

		case 'int':
			return FILTER_VALIDATE_INT;
			
		case 'boolean':
			return FILTER_VALIDATE_BOOLEAN;
		
		case 'float':
			return FILTER_VALIDATE_FLOAT;

		case 'validate_regexp':
			return FILTER_VALIDATE_REGEXP;

		case 'validate_url':
			return FILTER_VALIDATE_URL;

		case 'validate_email':
			return FILTER_VALIDATE_EMAIL;

		case 'validate_ip':
			return FILTER_VALIDATE_IP;

		case 'string':
			return FILTER_SANITIZE_STRING;

		case 'stripped':
			return FILTER_SANITIZE_STRIPPED;

		case 'encoded':
			return FILTER_SANITIZE_ENCODED;

		case 'special_chars':
			return FILTER_SANITIZE_SPECIAL_CHARS;

		case 'unsafe_raw':
			return FILTER_UNSAFE_RAW;

		case 'email':
			return FILTER_SANITIZE_EMAIL;

		case 'url':
			return FILTER_SANITIZE_URL;

		case 'number_int':
			return FILTER_SANITIZE_NUMBER_INT;

		case 'number_float':
			return FILTER_SANITIZE_NUMBER_FLOAT;

		case 'magic_quotes':
			return FILTER_SANITIZE_MAGIC_QUOTES;

		case 'callback':
			return FILTER_CALLBACK;

	}

	return false;
}//end function filter_id

/**
 * Filters a variable with a specified filter.
 * 
 * @param mixed $variable The variable to filter.
 * @param int $filter The various filters to apply to $variable
 * @param mixed $options Associative array of options or bitwise disjunction of flags
 */
function filter_var($variable, $filter = FILTER_DEFAULT, $options = 0)
{
	$return = $variable;
	$flags = 0;
	$opts = array();

	// if filter does not exists
	if (!(($filter >= 0x0200 && $filter <= 0x020a)
		|| ($filter >= 0x0100 && $filter <= 0x0114)
		|| $filter == FILTER_CALLBACK)
	) {
		return FALSE;
	}

	if(is_array($options)) {
		
		if(array_key_exists('flags', $options)) {
			$flags = $options['flags'];
		}

		if(array_key_exists('options', $options)) {
			$opts = $options['options'];
		}
	}
	else {
		$flags = $options;
	}

	if(is_array($variable)) {
		// require scalar
		if (!($flags & FILTER_REQUIRE_ARRAY || $flags & FILTER_FORCE_ARRAY)
			|| $flags & FILTER_REQUIRE_SCALAR
		) {
			if ($flags & FILTER_NULL_ON_FAILURE) {
				return null;
			} else {
				return false;
			}
		}

		$subFlags = $flags;

		if ($subFlags & FILTER_FORCE_ARRAY) {
			$subFlags ^= FILTER_FORCE_ARRAY;
		}

		if ($subFlags & FILTER_REQUIRE_ARRAY) {
			$subFlags ^= FILTER_REQUIRE_ARRAY;
		}

		foreach ($variable as $key => $element) {
			$variable[$key] = filter_var($element, $filter, array(
				'flags'   => $subFlags,
				'options' => $opts,
			));
		}

		return $variable;
	}

	if ($flags & FILTER_REQUIRE_ARRAY) {
		if ($flags & FILTER_NULL_ON_FAILURE) {
			return null;
		} else {
			return false;
		}
	}

	if (is_object($variable)) {
		if (!method_exists($variable, '__toString')) {
			if ($flags & FILTER_FORCE_ARRAY) {
				return array(false);
			} else {
				return false;
			}
		} else {
			$variable = $variable->__toString();
		}
	}

	$return = $variable = (string) $variable;

	if($filter == FILTER_VALIDATE_BOOLEAN) {
		$return = FALSE;

		if($variable === '1' || $variable === 'true' || $variable === 'on' || $variable === 'yes') {
			$return = TRUE;
		}
		elseif($variable === '0' || $variable === 'false' || $variable === 'off' || $variable === 'no') {
			$return = FALSE;
		}
		elseif($flags & FILTER_NULL_ON_FAILURE) {
			$return = NULL;
		}
	}
	elseif($filter == FILTER_VALIDATE_EMAIL) {
		$return = FALSE;
		
		if(strlen($variable) > 0 && preg_match(_FILTER_EMAIL_REGEX, $variable, $matches)) {
			$return = $matches[0];	
		}
		elseif($flags & FILTER_NULL_ON_FAILURE) {
			$return = NULL;
		}

	}
	elseif($filter == FILTER_VALIDATE_FLOAT) {
		$return = FALSE;

		$variable = trim($variable);

		if($flags == FILTER_FLAG_ALLOW_THOUSAND) {
			$variable = str_replace(',', '', $variable);
		}
		
		if(strlen($variable) > 0 && preg_match(_FILTER_FLOAT_REGEX, $variable) === 1) {
			$return = floatval($variable);
		}
		elseif($flags & FILTER_NULL_ON_FAILURE) {
			$return = NULL;
		}

	}
	elseif($filter == FILTER_VALIDATE_INT) {
		$return = FALSE;

		$variable = trim($variable);

		if(strlen($variable) > 0 && 
		  ($variable === '0' || preg_match(_FILTER_INT_BASE10_REGEX, $variable) === 1) ||
		  ($flags & FILTER_FLAG_ALLOW_OCTAL && preg_match(_FILTER_INT_OCTAL_REGEX, $variable)) ||
		  ($flags & FILTER_FLAG_ALLOW_HEX && preg_match(_FILTER_INT_HEX_REGEX, $variable)) 
		) {

			$base = 10;

			if($flags & FILTER_FLAG_ALLOW_HEX && (
			  strpos($variable, '0x') === 0
			  //|| strpos($variable, '-0x') === 0
			  || strpos($variable, '0X') === 0
			  //|| strpos($variable, '-0X') === 0
			)) {
				$base = 16;
			}
			elseif($flags & FILTER_FLAG_ALLOW_OCTAL && (
			  strpos($variable, '0') === 0
			  //|| strpos($variable, '-0') === 0
			)) {
				$base = 8;
			}

			$return = intval($variable, $base);

			if(array_key_exists('min_range', $opts)) {
				$min_range = intval($opts['min_range']);

				if($min_range > $return) {
					$return = false;
				}
			}

			if($return !== FALSE) {
				if(array_key_exists('max_range', $opts)) {
					$max_range = intval($opts['max_range']);

					if($max_range < $return) {
						$return = false;
					}
				}
			}
		}

		if($return === FALSE && $flags & FILTER_NULL_ON_FAILURE) {
			$return = NULL;
		}
	}
	elseif($filter == FILTER_VALIDATE_IP) {
		$return = FALSE;

		if(strlen($variable) > 0) {
			
			$mode = null;
			if(false !== strpos($variable, ':')) {
				$mode = 6;
			} elseif (false !== strpos($variable, '.')) {
				$mode = 4;
			} else {
				$mode = null;
				$return = FALSE;
			}

			if (($flags & FILTER_FLAG_IPV4) && ($flags & FILTER_FLAG_IPV6)) {
				/* Both formats are cool */
			} elseif (($flags & FILTER_FLAG_IPV4) && 6 === $mode) {
				$mode = null;
				$return = FALSE;
			} elseif (($flags & FILTER_FLAG_IPV6) && 4 === $mode) {
				$mode = null;
				$return = FALSE;
			}

			//Check IPv4 addresses...
			if(4 === $mode
			  && preg_match(_FILTER_IPV4_REGEX, $variable, $matches) === 1) {

				$return = $variable;

				//Check if private range IPv4 addresses are not allowed...
				if($flags & FILTER_FLAG_NO_PRIV_RANGE) {
					if (($matches[1] == 10)
						|| ($matches[1] == 172 && ($matches[2] >= 16 && $matches[2] <= 31))
						|| ($matches[1] == 192 && $matches[2] == 168)
					) {
						$return = FALSE;
					}
				}

				if ($flags & FILTER_FLAG_NO_RES_RANGE) {
					if (($matches[1] == 0)
						|| ($matches[1] == 100 && ($matches[2] >= 64 && $matches[2] <= 127))
						|| ($matches[1] == 169 && $matches[2] == 254)
						|| ($matches[1] == 192 && $matches[2] == 0 && $matches[3] == 2)
						|| ($matches[1] == 127 && $matches[2] == 0 && $matches[3] == 0 && $matches[4] == 1)
						|| ($matches[1] >= 224 && $matches[1] <= 255)
					) {
						$return = FALSE;
					}
				}
			}
			//Check IPv6 addresses...
			elseif(6 === $mode
			  && preg_match(_FILTER_IPV6_REGEX, $variable) === 1) {
				
				$return = $variable;

				//Check if private range IPv6 addresses are not allowed...
				if($flags & FILTER_FLAG_NO_PRIV_RANGE) {
					if (strlen($variable) >= 2
						&& (!strncasecmp('FC', $variable, 2) || !strncasecmp('FD', $variable, 2))
					) {
						$return = FALSE;
					}
				}

				if ($flags & FILTER_FLAG_NO_RES_RANGE) {
					$len = strlen($variable);
					switch ($len) {
						case 1: case 0:
							break;
						case 2:
							if (!strcmp('::', $variable)) {
								$return = FALSE;
							}
							break;
						case 3:
							if (!strcmp('::1', $variable) || !strcmp('5f:', $variable)) {
								$return = FALSE;
							}
							break;
						default:
							if (5 <= $len) {
								if (!strncasecmp('fe8', $variable, 3)
									|| !strncasecmp('fe9', $variable, 3)
									|| !strncasecmp('fea', $variable, 3)
									|| !strncasecmp('feb', $variable, 3)
								) {
									$return = FALSE;
									break;
								}
							}

							if ((9 <= $len && !strncasecmp('2001:0db8', $variable, 9))
								|| (2 <= $len && !strncasecmp('5f', $variable, 2))
								|| (4 <= $len && !strncasecmp('3ff3', $variable, 4))
								|| (8 <= $len && !strncasecmp('2001:001', $variable, 8))
							) {
								$return = FALSE;
								break;
							}
					}
				}
			}
		}

		if($return === FALSE && $flags & FILTER_NULL_ON_FAILURE) {
			$return = NULL;
		}
	}
	elseif($filter == FILTER_VALIDATE_REGEXP) {
		$return = FALSE;

		if(strlen($opts['regexp']) > 0) {
			if(preg_match($opts['regexp'], $variable) > 0) {

				$return = $variable;
			}
		}
		else {

			$debug_backtrace = debug_backtrace();
			
			trigger_error("filter_var(): 'regexp' option missing in {$debug_backtrace[0]['file']} on line {$debug_backtrace[0]['line']}", E_USER_WARNING);
		}

		if($return === FALSE && $flags & FILTER_NULL_ON_FAILURE) {
			$return = NULL;
		}
	}
	elseif($filter == FILTER_VALIDATE_URL) {
		$return = FALSE;

		if(strlen($variable)) {
			
			$parsed_url = parse_url($variable);


			if($parsed_url) {

				$return = $variable;

				if($return !== FALSE 
				  && ($flags & FILTER_FLAG_PATH_REQUIRED)
				  && !isset($parsed_url['path'])) {
					
					$return = FALSE;
				}

				if($return !== FALSE 
				  && ($flags & FILTER_FLAG_QUERY_REQUIRED)
				  && !isset($parsed_url['query'])) {

					$return = FALSE;
				}
			}
		}

		if($return === FALSE && $flags & FILTER_NULL_ON_FAILURE) {
		    $return = NULL;
		}
	}
	elseif($filter == FILTER_SANITIZE_EMAIL) {
		
		$return = preg_replace(_FILTER_SANITIZE_EMAIL_REGEX, '', $variable);
	}
	elseif($filter == FILTER_SANITIZE_ENCODED) {

		$return = rawurlencode($variable);
	}
	elseif($filter == FILTER_SANITIZE_MAGIC_QUOTES) {

		$return = addslashes($variable);
	}
	elseif($filter == FILTER_SANITIZE_NUMBER_FLOAT) {

		$return = preg_replace(_FILTER_SANITIZE_NUMBER_FLOAT_REGEX1, '', $variable);

		if(!($flags & FILTER_FLAG_ALLOW_FRACTION)) {

			$return = str_replace('.', '', $return);
		}

		if(!($flags & FILTER_FLAG_ALLOW_THOUSAND)) {

			$return = str_replace(',', '', $return);
		}

		if(!($flags & FILTER_FLAG_ALLOW_SCIENTIFIC)) {

			$return = str_ireplace('e', '', $return);
		}
	}
	elseif($filter == FILTER_SANITIZE_NUMBER_INT) {

		$return = preg_replace('/[^\d]/', '', $variable);
	}
	elseif($filter == FILTER_SANITIZE_SPECIAL_CHARS) {

		$search = array('&', "'", '"', '<');
		$replace = array('&#38;', '&#39;', '&#34;', '&#60;');

		$return = str_replace($search, $replace, $variable);

		//Sanitize low and high characters

		$tmp_return = '';

		for($i = 0, $li = strlen($return); $i < $li; $i++) {

			$char = substr($return, $i, 1);
			$ord = ord($char);
			
			if($ord < 32) {

				if($flags & FILTER_FLAG_STRIP_LOW) {
					//do nothing
				}
				else {

					$tmp_return .= '&#'.$ord.';';
				}
			}
			elseif($ord > 127 && $flags & FILTER_FLAG_STRIP_HIGH) {

				//do nothing
			}
			elseif($ord > 127 && $flags & FILTER_FLAG_ENCODE_HIGH) {

				$tmp_return .= '&#'.$ord.';';
			}
			else {

				$tmp_return .= $char;
			}
		}

		$return = $tmp_return;

	}

	if ($flags & FILTER_FORCE_ARRAY) {
		$return = (array) $return;
	}

	return $return;

}//end funcfion filter_var
