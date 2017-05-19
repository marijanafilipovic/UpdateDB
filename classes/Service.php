<?php
/** 
* Automaticly creates new Zip Arhive and
* change pocessed data with random function
* from constructor
*/
class Service
{
    protected $dbh;
    public $conn;

    private function __construct()
    {
        $zip = new ZipArchive;
        $res = $zip->open('akcije.zip');
        if ($res === TRUE) {
            $zip->extractTo('xml/');
            $zip->close();
            // echo 'ziped!';
        } else {
            // echo 'not ziped!';
        }

        $xmlDoc= new DOMDocument();
        $xmlDoc->load("xml/akcije.xml");
        $xmlObject = $xmlDoc->getElementsByTagName('item');
        $itemCount = $xmlObject->length;

        for ($i=0; $i < $itemCount; $i++) {
            $stock = $xmlObject->item($i)->getElementsByTagName('symbol')->item(0)->childNodes->item(0)->nodeValue;
            $max = $xmlObject->item($i)->getElementsByTagName('max')->item(0)->childNodes->item(0)->nodeValue;

            $conn = $this->dbh = Connect::getInstance();
            $sql = $conn->prepare('UPDATE stat SET Cena_max = :max WHERE Simbol = :stock');
            $sql->bindParam(':max', $max);
            $sql->bindParam(':stock', $stock);
            $sql->execute();
        }

    }
}
