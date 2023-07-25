<?php
    namespace App\Models;

    use App\Interfaces\ReportFormattable;
    use App\Models\Reading;

    class JsonReportFormatter implements ReportFormattable
    {
        public function format(Reading $data)
        {
            return $data->getContents();
        }
    }