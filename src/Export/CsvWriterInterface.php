<?php

namespace Dentist\Export;

interface CsvWriterInterface
{
    public function exportDataToCSV($patients):void;
}