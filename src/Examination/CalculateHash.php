<?php // UTF-8 marker äöüÄÖÜß€
require_once './Page.php';

class CalculateHash extends Page
{
    private $hash = "";

    protected function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    protected function getViewData()
    {
    }

    protected function generateView()
    {
        header("Content-Type: application/json; charset=UTF-8");

        if ($this->hash != null) {

            $serializedData = json_encode($this->hash);
            echo $serializedData;
        }
    }


    protected function processReceivedData()
    {
        parent::processReceivedData();

        if (isset($_GET["url"])) {
            //if ($_GET["jsurl"] != null) {
            $this->hash = hash('crc32', $_GET["url"]);
            // }

        }

    }

    public static function main()
    {
        try {
            $page = new CalculateHash();
            $page->processReceivedData();
            $page->generateView();
        } catch (Exception $e) {
            header("Content-type: text/plain; charset=UTF-8");
            echo $e->getMessage();
        }
    }
}

CalculateHash::main();
