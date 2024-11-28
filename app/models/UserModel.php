namespace App\models;

use PDO;

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new \Core\Database();
    }

    public function saveUrl($url, $shortCode)
    {
        $stmt = $this->db->getConnection()->prepare("INSERT INTO urls (url, short_code) VALUES (:url, :short_code)");
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':short_code', $shortCode);
        $stmt->execute();
    }

    public function getUrlByShortCode($shortCode)
    {
        $stmt = $this->db->getConnection()->prepare("SELECT url FROM urls WHERE short_code = :short_code");
        $stmt->bindParam(':short_code', $shortCode);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}

