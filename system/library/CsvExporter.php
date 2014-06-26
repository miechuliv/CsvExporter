<?php
/**
 * Created by JetBrains PhpStorm.
 * User: USER
 * Date: 26.06.14
 * Time: 11:06
 * To change this template use File | Settings | File Templates.
 */

class CsvExporter {

    protected $_outputFile;
    protected $_outputFileHandle;
    protected $_delimiter = ',';
    protected $_columns;
    protected $_numberOfColumns;
    protected $_rowCount = 0;

    protected $_validators = array();

    private function _saveRow($row)
    {
        if(is_array($row))
        {
            if(count($row) != $this->_numberOfColumns)
            {
                throw new Exception('Data row not matching columns on row: '.$this->_rowCount);
            }
            else
            {
                fputcsv($this->_outputFileHandle,$row,$this->_delimiter);
                return 1;
            }


        }

        return 0;
    }

    public function initOutputFile($filename)
    {
        if(!file_exists($filename))
        {
            touch($filename);
            chmod($filename,0777);
        }

        $this->_outputFile = $filename;
        $this->_outputFileHandle = fopen($this->_outputFile,'w');

        return $this;
    }

    public function setHeaders($headers)
    {
            if(!is_resource($this->_outputFileHandle))
            {
                throw new Exception('No handle for file: '.$this->_outputFile);
            }

            if(!is_array($headers) || empty($headers))
            {
                throw new Exception('Headers must be a non empty array');
            }

            fputcsv($this->_outputFileHandle,$headers,$this->_delimiter);
            $this->_columns = $headers;
            $this->_numberOfColumns = count($headers);

            return $this;

    }

    public function export($data)
    {
        if(!is_resource($this->_outputFileHandle))
        {
            throw new Exception('No handle for file: '.$this->_outputFile);
        }

        $this->_rowCount = 0;

        if(is_array($data))
        {
            foreach($data as $row)
            {
                $this->_rowCount += $this->_saveRow($row);
            }
        }

        return $this->_rowCount;

    }

}