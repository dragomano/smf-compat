<?php declare(strict_types=1);

if (! defined('SMF_VERSION'))
	return;

use Bugo\Compat\{ACP, BBCodeParser, Board, CacheApi, Calendar, Config};
use Bugo\Compat\{Db, Editor, ErrorHandler, IntegrationHook, ItemList};
use Bugo\Compat\{Lang, Logging, Mail, Menu, MessageIndex, Msg, Notify, PageIndex};
use Bugo\Compat\{Sapi, Security, ServerSideIncludes, Theme};
use Bugo\Compat\{Topic, User, Utils, WebFetchApi};

if (str_starts_with(SMF_VERSION, '3.0')) {
	$aliases = [
		'SMF\\ServerSideIncludes'    => ServerSideIncludes::class,
		'SMF\\IntegrationHook'       => IntegrationHook::class,
		'SMF\\ErrorHandler'          => ErrorHandler::class,
		'SMF\\BBCodeParser'          => BBCodeParser::class,
		'SMF\\Actions\\MessageIndex' => MessageIndex::class,
		'SMF\\WebFetch\\WebFetchApi' => WebFetchApi::class,
		'SMF\\PageIndex'             => PageIndex::class,
		'SMF\\Cache\\CacheApi'       => CacheApi::class,
		'SMF\\ItemList'              => ItemList::class,
		'SMF\\Security'              => Security::class,
		'SMF\\Actions\\Calendar'     => Calendar::class,
		'SMF\\Logging'               => Logging::class,
		'SMF\\Editor'                => Editor::class,
		'SMF\\Actions\\Notify'       => Notify::class,
		'SMF\\Config'                => Config::class,
		'SMF\\Board'                 => Board::class,
		'SMF\\Topic'                 => Topic::class,
		'SMF\\Theme'                 => Theme::class,
		'SMF\\Utils'                 => Utils::class,
		'SMF\\Lang'                  => Lang::class,
		'SMF\\Mail'                  => Mail::class,
		'SMF\\Menu'                  => Menu::class,
		'SMF\\User'                  => User::class,
		'SMF\\Sapi'                  => Sapi::class,
		'SMF\\Actions\\Admin\\ACP'   => ACP::class,
		'SMF\\Msg'                   => Msg::class,
		'SMF\\Db\\DatabaseApi'       => Db::class,
	];

	$applyAlias = static fn($class, $alias) => class_alias($class, $alias);

	array_map($applyAlias, array_keys($aliases), $aliases);
} else {
	array_map(fn($u) => new $u(), [
		Db::class,
		Lang::class,
		User::class,
		Theme::class,
		Board::class,
		Topic::class,
		Utils::class,
		Config::class,
	]);
}
