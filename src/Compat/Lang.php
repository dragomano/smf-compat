<?php declare(strict_types=1);

/**
 * Lang.php
 *
 * @package SMF Compat
 * @link https://github.com/dragomano/smf-compat
 * @author Bugo <bugo@dragomano.ru>
 * @copyright 2024 Bugo
 * @license https://opensource.org/license/mit/ MIT
 *
 * @version 0.1
 */

namespace Bugo\Compat;

use function censorText;
use function getLanguages;
use function loadLanguage;
use function sentence_list;

class Lang
{
	public static array $txt;

	public static array $editortxt;

	public static array $helptxt;

	public static string $forum_copyright;

	private array $vars = [
		'txt'       => 'txt',
		'editortxt' => 'editortxt',
		'helptxt'   => 'helptxt',
	];

	public function __construct()
	{
		foreach ($this->vars as $key => $value) {
			if (! isset($GLOBALS[$value])) {
				$GLOBALS[$value] = [];
			}

			self::${$key} = &$GLOBALS[$value];
		}

		if (! isset($GLOBALS['forum_copyright']))
			$GLOBALS['forum_copyright'] = '';

		self::$forum_copyright = &$GLOBALS['forum_copyright'];
	}

	public static function censorText(string &$text): void
	{
		censorText($text);
	}

	public static function get(): array
	{
		return getLanguages();
	}

	public static function load(string $language, string $lang = ''): void
	{
		loadLanguage($language, $lang);
	}

	public static function sentenceList(array $list): string
	{
		return sentence_list($list);
	}
}
