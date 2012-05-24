<?PHP
class Douban_Action_Fault extends Douban_Action_Abstract
{
	protected $needAuth = false;

	public function run()
	{
		$this->setResponse($this->ctx);
		$this->tpl('fault');
		$this->format(Su_Const::FT_HTML);
	}
}
