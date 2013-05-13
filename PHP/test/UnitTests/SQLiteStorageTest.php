<?php

use PHPIntel\Dumper\SQLiteDumper;
use PHPIntel\Reader\SQLiteReader;
use PHPIntel\Entity\Entity;

use \PHPUnit_Framework_Assert as PHPUnit;

class SQLiteStorageTest extends \PHPUnit_Framework_TestCase
{
    ////////////////////////////////////////////////////////////////////////
    // tests

    public function testDumpAndReadEntities()
    {
        $entities = $this->buildTestEntities();
        $test_sqlite_filepath = $GLOBALS['BASE_PATH'].'/test/data/.test_intel.sqlite3';

        // clear old test file
        if (file_exists($test_sqlite_filepath)) { unlink($test_sqlite_filepath); }

        $dumper = new SQLiteDumper($test_sqlite_filepath);
        $dumper->dump($entities);
        PHPUnit::assertTrue(file_exists($test_sqlite_filepath), "sqlite file not found");

        $reader = new SQLiteReader($test_sqlite_filepath);
        $read_entities = $reader->read();

        // see if what we read is what we expected
        PHPUnit::assertEquals($read_entities, $entities);

        // clean up
        if (file_exists($test_sqlite_filepath)) { unlink($test_sqlite_filepath); }
    }

    ////////////////////////////////////////////////////////////////////////
    // util

    protected function buildTestEntities()
    {
        return array(
            new Entity(array(
                'label'      => 'function1',
                'completion' => 'function1($a, $b)',

                'filepath'   => null,
                'class'      => null,
                'type'       => null,
                'visibility' => null,
                'scope'      => null,
            )),
            new Entity(array(
                'label'      => 'function2',
                'completion' => 'function2($a, $b)',

                'filepath'   => null,
                'class'      => null,
                'type'       => null,
                'visibility' => null,
                'scope'      => null,
              )),
            );
    }
}
