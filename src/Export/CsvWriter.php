<?php

namespace Dentist\Export;

class CsvWriter implements CsvWriterInterface
{
    public function exportDataToCSV($patients):void
    {
        $delimiter = ",";
        $filename = "patient-data_" . date('Y-m-d') . ".csv";

        //Crate a file pointer
        $f = fopen($filename, 'w');

        //Set column headers
        $fields = ['NATIONAL ID', 'NAME', 'EMAIL', 'PHONE', 'DATE AND TIME'];
        fputcsv($f, $fields, $delimiter);

        // Output each row of the data, format line as csv and write to file pointer
        foreach ($patients as $patient) {
            $lineData = [ $patient->nationalId, $patient->name, $patient->email, $patient->phone, $patient->dateTime ];
            fputcsv($f, $lineData, $delimiter);
        }
        // Move back to beginning of file
        fseek($f, 0);
    }
}
