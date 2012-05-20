<?PHP
class Douban_Action_Fault extends Douban_Action_Abstract
{
	protected $_needAuth = false;

	public function run()
	{
		$this->response($this->ctx);
		$this->tpl('fault');
	}
}
