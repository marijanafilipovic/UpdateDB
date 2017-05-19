<?php

/**
 * From constructor get randomly xml data and 
 * change value of two columns 
 * Function ZipUp() Process XML data to Ziped file
 * Date: 5/9/2017
 * Time: 11:38 PM
 */
class Trade
{
    protected $dbh;
    public $conn;

    public function __construct()
    {
        $conn = $this->dbh = Connect::getInstance();
        $query = "SELECT * FROM stat ORDER BY RAND() LIMIT 40 ";
        $stocksArray = array();

        if ($result = $conn->query($query)) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                array_push($stocksArray, $row);

            }

            if (count($stocksArray)) {


                $filePath = 'akcije.xml';

                $dom = new DOMDocument('1.0', 'utf-8');

                $root = $dom->createElement('items');

                for ($i = 0; $i < count($stocksArray); $i++) {

                    $stockId = $stocksArray[$i]['Simbol'];

                    $stockMax = $stocksArray[$i]['Cena_max'] - random_int(200, 300);

                    $stockMin = $stocksArray[$i]['Cena_min'] * random_int(1.1, 1.3);

                    $item = $dom->createElement('item');

                    $item->setAttribute('id', $stockId);

                    $symbol = $dom->createElement('symbol', $stockId);

                    $item->appendChild($symbol);

                    $max = $dom->createElement('max', $stockMax);

                    $item->appendChild($max);

                    $min = $dom->createElement('min', $stockMin);

                    $item->appendChild($min);

                    $root->appendChild($item);

                }

                $dom->appendChild($root);

                $dom->save($filePath);

            }


        }

    }


    public function zipUp()
    {
        $file_folder = '/';
        $file = "akcije.xml";
        $zip = new ZipArchive();
        $zip_name = "akcije.zip";
        if ($zip->open($zip_name, ZIPARCHIVE::CREATE) !== TRUE) {

           echo "* Sorry ZIP creation failed";

        } else {
            $zip->addFile($file);

        }
    }
}
