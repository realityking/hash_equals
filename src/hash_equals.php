<?php
/**
 * This file is part of the hash_equals library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) 2013-2014 Rouven Weßling <http://rouvenwessling.de>
 * @license http://opensource.org/licenses/MIT MIT
 */

if (!function_exists('hash_equals')) {
	function hash_equals($known_string, $user_string)
	{
		// We jump trough some hoops to match the internals errors as closely as possible
		$argc = func_num_args();
        $params = func_get_args();
        
        if ($argc < 2) {
            trigger_error("hash_equals() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
            return null;
        }
        
        if (!is_string($known_string)) {
        	trigger_error("hash_equals(): Expected known_string to be a string, " . gettype($known_string) . " given", E_USER_WARNING);
            return false;
        }

        if (!is_string($user_string)) {
        	trigger_error("hash_equals(): Expected user_string to be a string, " . gettype($user_string) . " given", E_USER_WARNING);
            return false;
        }
        
        if (strlen($known_string) !== strlen($user_string)) {
        	return false;
        }

		$len = strlen($known_string);
		$result = 0;
        for ($i = 0; $i < $len; $i++) {
            $result |= (ord($known_string[$i]) ^ ord($user_string[$i]));
        }

        // They are only identical strings if $result is exactly 0...
        return 0 === $result;
	}
}
