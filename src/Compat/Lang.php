<?php declare(strict_types=1);

/**
 * @package SMF Compat
 * @link https://github.com/dragomano/smf-compat
 * @author Bugo <bugo@dragomano.ru>
 * @copyright 2024-2025 Bugo
 * @license https://opensource.org/license/mit/ MIT
 */

namespace Bugo\Compat;

use IntlException;
use MessageFormatter;

use function censorText;
use function comma_format;
use function getLanguages;
use function is_array;
use function is_string;
use function loadLanguage;
use function sentence_list;
use function tokenTxtReplace;

class Lang
{
	public const LANG_TO_LOCALE = [];

	public static array $txt;

	public static array $editortxt;

	public static array $helptxt;

	public static string $forum_copyright;

	private array $vars = [
		'txt'             => [],
		'editortxt'       => [],
		'helptxt'         => [],
		'forum_copyright' => '',
	];

	public function __construct()
	{
		foreach ($this->vars as $key => $value) {
			if (! isset($GLOBALS[$key])) {
				$GLOBALS[$key] = $value;
			}

			self::${$key} = &$GLOBALS[$key];
		}
	}

	public static function censorText(string &$text): void
	{
		censorText($text);
	}

	public static function get(): array
	{
		return getLanguages();
	}

	public static function load(string $template_name, string $lang = ''): void
	{
		loadLanguage($template_name, $lang);
	}

	public static function sentenceList(array $list): string
	{
		return sentence_list($list);
	}

	public static function getTxt(string|array $key, array $args = [], string $var = 'txt'): string
	{
		if ($args === [] && is_string($key)) {
			return self::${$var}[$key] ?? '';
		}

		if (is_array($key)) {
			if (isset($key[0], $key[1])) {
				return self::${$var}[$key[0]][$key[1]] ?? '';
			}

			return '';
		}

		$pattern = self::${$var}[$key] ?? $key;

		try {
			$formatter = new MessageFormatter(self::$txt['lang_locale'] ?? 'en_US', $pattern);

			return $formatter->format($args);
		} catch (IntlException $e) {
			ErrorHandler::log("Lang::getTxt: {$e->getMessage()} in '\${$var}[$key]'", 'critical');

			return '';
		}
	}

	public static function tokenTxtReplace(string $string = ''): string
	{
		return tokenTxtReplace($string);
	}

	public static function numberFormat(int|float|string $number, ?int $decimals = null): string
	{
		return comma_format($number, $decimals);
	}
}
