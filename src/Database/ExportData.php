<?php

namespace Dentist\Database;

class ExportData extends Database
{
    public function exportDataToCSV()
    {
        //Fetch record from database
        $query = $this->connect()->query("SELECT * FROM patient ORDER BY datetime ASC");

        $delimiter = ",";
        $filename = "patient-data_" . date('Y-m-d') . ".csv";

        //Crate a file pointer
        $f = fopen($filename, 'w');

        //Set column headers
        $fields = ['NATIONAL ID', 'NAME', 'EMAIL', 'PHONE', 'DATE AND TIME'];
        fputcsv($f, $fields, $delimiter);

        // Output each row of the data, format line as csv and write to file pointer
        while ($row = $query->fetch()) {
            $lineData = [$row["nationalId"],$row["name"],$row["email"],$row["phone"],$row["datetime"]];
            fputcsv($f, $lineData, $delimiter);
        }
        // Move back to beginning of file
        fseek($f, 0);
    }
}
