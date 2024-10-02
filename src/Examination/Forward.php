<?php // UTF-8 marker äöüÄÖÜß€
require_once './Page.php';

class DBException extends Exception
{
}

class Forward extends Page
{
    private $urls = array();

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

        $this->Recordset = $this->db->query("select * from hash2URL;"); //SQL Anfrage
        if (!$this->Recordset) {
            printf("Query failed: %s\n", $this->Recordset->error);
            exit();
        }

        while ($record = $this->Recordset->fetch_assoc()) {

            $tempArray = array(
                "id" => $record["id"],
                "url" => $record["url"],
                "timestamp" => $record["timestamp"],
                "hash" => $record["hash"]
            );

            $this->urls[] = $tempArray;
        }
    }

    protected function generateView()
    {
        $this->generatePageHeader('to do: change headline');

        for ($i = 0; $i < count($this->urls); $i++) {
            echo "ayy";
        }
        echo "bruh";

        $this->generatePageFooter();
    }


    protected function processReceivedData()
    {
        parent::processReceivedData();
    }

    public static function main()
    {
        try {
            $page = new Forward();
            $page->processReceivedData();
            $page->generateView();
        } catch (Exception $e) {
            header("Content-type: text/plain; charset=UTF-8");
            echo $e->getMessage();
        }
    }
}

Forward::main();
