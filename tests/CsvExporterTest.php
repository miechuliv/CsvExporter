<?php
/**
 * Created by JetBrains PhpStorm.
 * User: USER
 * Date: 26.06.14
 * Time: 11:43
 * To change this template use File | Settings | File Templates.
 */
include_once(__DIR__.'/../CsvExporter.php');

class CsvExporterTest extends PHPUnit_Framework_TestCase {

     public function testIsFileCreated()
     {
         $headers = array(
             'head1',
             'head2',
             'head3'
         );

         $data = array(
             array(
                 'val11',
                 'val12',
                 'val13'
             ),
             array(
                 'val21',
                 'val22',
                 'val23'
             )
         );

         $obj = new CsvExporter();
         $filename = __DIR__.'/output.csv';
         $rowsProcessed = $obj->initOutputFile($filename)
            ->setHeaders($headers)
            ->export($data);

         $this->assertEquals(2,$rowsProcessed);
         $this->assertTrue(file_exists($filename));
     }

}
