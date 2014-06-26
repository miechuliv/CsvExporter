<?php
/**
 * Created by JetBrains PhpStorm.
 * User: USER
 * Date: 26.06.14
 * Time: 12:17
 * To change this template use File | Settings | File Templates.
 */

class ControllerExportCSV extends Controller{

    public function export()
    {
        include_once(DIR_SYSTEM.'library/CsvExporter.php');
        $exporter = CsvExporter();

        $filename = DIR_APPLICATION.'../export/export.csv';

        $headers = array(
            'product_id',
            'name',
            'description',
            'ean',
            'category',
            'price',
            'quantity',
            'status',
            'comment',
            'image',

        );

        $this->load->model('export/csv');

        $data = $this->model_export_csv->getProductData();

        $rowsProcessed = $exporter->initOutputFile($filename)
            ->setHeaders($headers)
            ->export($data);

        var_dump($rowsProcessed);
    }
}