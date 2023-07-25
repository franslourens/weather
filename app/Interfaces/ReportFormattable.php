<?php
    namespace App\Interfaces;
    use App\Models\Reading;

    interface ReportFormattable
    {
        public function format(Reading $data);
    }