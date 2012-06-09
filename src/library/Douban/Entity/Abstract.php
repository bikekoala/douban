<?PHP
class Douban_Entity_Abstract
{
	protected $pdo;
	protected $conf;
	protected $table;

	public function __construct()
	{
		$this->conf = Douban_Config::single();
		$this->pdo = Su_Db::getInstance($this->conf['pdo']);
	}
}
