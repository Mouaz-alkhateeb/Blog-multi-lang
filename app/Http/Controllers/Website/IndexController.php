<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class IndexController extends Controller
{
    public  function index()
    {
        $categories_with_posts = Category::with(['posts' => function ($query) {
            $query->latest()->limit(3);
        }])->get();
        return view('website.index', compact('categories_with_posts'));
    }

    public function export()
    {


        $table_attributes = DB::getSchemaBuilder()->getColumnListing('users');
        $users = User::all();
        $spreadsheet = new Spreadsheet();

        $activeWorksheet = $spreadsheet->getActiveSheet();


        $i = 'A';
        foreach ($table_attributes as $value) {
            if ($value == 'password') {
                continue;  // Skip the 'password' column
            }
            $activeWorksheet->setCellValue($i . '1', $value);
            $activeWorksheet->getStyle($i . '1')->getAlignment()->setHorizontal('center');
            $activeWorksheet->getColumnDimension($i)->setWidth(30);
            $activeWorksheet->getStyle($i . '1')->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('d279d2');
            $header_columns[] = [$i => $value];
            $i++;
        }


        $i = 'A';
        $key_index = 2;
        foreach ($header_columns as $key => $value) {
            foreach ($users as $userKey => $userValue) {
                $name = $value[$i];
                if ($name == 'password') {
                    continue;  // Skip the 'password' column
                }
                $theKey = key($value);
                $activeWorksheet->setCellValue($theKey . $key_index, $userValue->$name);
                $activeWorksheet->getStyle($theKey . $key_index)->getAlignment()->setHorizontal('center');

                $activeWorksheet->getStyle($theKey . $key_index)
                    ->getBorders()
                    ->getOutline()
                    ->setBorderStyle(Border::BORDER_THICK);


                $key_index++;
            }
            $i++;
            $key_index = 2;
        }


        // $activeWorksheet->setCellValue('J1', 'Total');
        // $activeWorksheet->mergeCells('J1:K1');
        // $activeWorksheet->getStyle('J1:K1')->getAlignment()->setHorizontal('center');
        // $activeWorksheet->getColumnDimension('J')->setWidth(30);
        // $activeWorksheet->getColumnDimension('K')->setWidth(30);


        $writer = new Xlsx($spreadsheet);
        $writer->save('users.xlsx');


        $file_name = Date('Y-m-d') . '-users.xlsx';

        return response()->download(public_path('users.xlsx'), $file_name, [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Dispostion' => 'inline,file_name=" ' . $file_name . ' "'
        ]);
    }

    public function read()
    {
        $file = public_path('users.xlsx');

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadsheet = $reader->load($file);

        $sheet = $spreadsheet->getActiveSheet();

        dd($sheet->toArray());
    }
}