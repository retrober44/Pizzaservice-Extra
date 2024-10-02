<?php // UTF-8 marker äöüÄÖÜß€
require_once './Page.php';

class GenerateLink extends Page
{

    private $msg = "";

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
        $this->generatePageHeader('h_da Link Shortner');

        echo <<<EOT

        <body onload="init();">

        <img src="randombild.jpg" " width="200" height="200" >
        <a href="Home.php">Home</a>
        <a href="Products.php">Products</a>
        <a href="Company.php">Company</a>
        <a href="Blog.php">Blog</a>

        <h1>Link Shortner!</h1>

  
        <form action="index.php" id="formular" method="post" accept-charset="UTF-8">
        <div>        
        <p>Url: <input type="text" id="urlform" name="URL" required></p>
        <p><input type="submit" value="senden"></p></p>
        <p>Send a URL and we shorten it for you!</p>
        <p>Hash: <input type="text" id="inputHash" name="HASH" value=""></p>
        </div>
        </form>
EOT;
        if ($this->msg != "") {
            echo $this->msg;
        }


        echo <<<EOT
        </body>	

EOT;        
        $this->generatePageFooter();
    }

    protected function processReceivedData()
    {
        parent::processReceivedData();

        if (isset($_POST["HASH"]) && isset($_POST["URL"])) {
            if ($_POST["HASH"] != null && $_POST["URL"] != null) {
                $hash = $_POST["HASH"];
                $url = "https://" . $_POST["URL"] . "/";
                $sqlanfrage = "INSERT INTO hash2URL (url,hash) VALUES ('$url', '$hash' ); ";
                $this->db->query($sqlanfrage);
                $this->msg = "wurde erfolgreich in die Datenbank gespeichert";

            }
        }


    }

    public static function main()
    {
        try {
            $page = new GenerateLink();
            $page->processReceivedData();
            $page->generateView();
        } catch (Exception $e) {
            header("Content-type: text/plain; charset=UTF-8");
            echo $e->getMessage();
        }
    }
}

GenerateLink::main();
