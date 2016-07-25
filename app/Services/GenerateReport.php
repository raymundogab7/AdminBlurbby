<?php namespace Admin\Services;

class GenerateReport
{
    public function generate($reportType, $file_name = 'CAMPAIGN REPORT')
    {
        $headers = array();
        $valueArray = array();

        \Excel::create($file_name, function ($excel) use ($reportType, $headers, $valueArray) {
            foreach ($reportType as $tyKey => $rtVal) {
                $excel->sheet($tyKey, function ($sheet) use ($rtVal, $headers, $valueArray) {
                    foreach ($rtVal as $rtValKey => $v) {
                        foreach ($v as $key => $value) {
                            $headers[$key] = $key;
                            $valueArray[] = $value;
                        }
                    }
                    $sheet->loadView('reports.campaign', array('report' => $headers, 'testArray' => $valueArray));
                });
            }
        })->download('xlsx');
    }
}
