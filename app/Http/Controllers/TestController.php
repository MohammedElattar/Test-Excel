<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use SimpleXMLElement;

class TestController extends Controller
{
    /**
     * @throws \Exception
     */
    public function import(Request $request)
    {
        $uploadedFile = $request->file('file');

        $tmpDirectory = uniqid().'/';


        $uploadedFile->move($tmpDirectory, $uploadedFile->getClientOriginalName());
        $excelFilePath = $tmpDirectory.$uploadedFile->getClientOriginalName();
//        $spreadsheet = IOFactory::load($excelFilePath);

        $zipArchive = new \ZipArchive();

        if($zipArchive->open($tmpDirectory.'/'.$uploadedFile->getClientOriginalName()))
        {
            $zipArchive->extractTo($tmpDirectory);
            $zipArchive->close();

            foreach(glob($tmpDirectory.'/'.'xl/worksheets/sheet1.xml') as $workSheetFile)
            {
                $xmlContent = file_get_contents($workSheetFile);
                $xml = new SimpleXMLElement($xmlContent);

                foreach ($xml->twoCellAnchor as $cellAnchor) {
                    echo 'iam here';
                    $image = $cellAnchor->pic->blipFill->blip;
                    $imageData = base64_decode((string) $image->attributes()['r:embed']);

                    info($imageData);
                }
//
            }
        }
    }
}
