<?php
require_once(__DIR__ . '/../bootstrap.php');

$availModes = array('gensqls', 'execute');

if ($argc < 2)
	die('Usage: ' . basename(__FILE__) . ' <entry id> [<mode: ' . implode('/', $availModes) . '>]' . PHP_EOL);

$entryId = @$argv[1];
$mode = 'execute';
if ($argc > 2)
	$mode = $argv[2];

if (!in_array($mode, $availModes))
	die('Invalid mode, should be one of ' . implode(',', $availModes) . PHP_EOL);

$dbConf = kConf::getDB();
DbManager::setConfig($dbConf);
DbManager::initialize();

$sphinx = new kSphinxSearchManager();

entryPeer::setUseCriteriaFilter(false);
$entry = entryPeer::retrieveByPK($entryId);
if ($entry)
{
	if ($mode == 'execute')
	{
		$sphinx->saveToSphinx($entry, false, true);
		echo $entry->getId() . "Saved\n";
	}
	else
	{
		print $sphinx->getSphinxSaveSql($entry, false, true) . PHP_EOL;
	}
}
echo "Done\n";
