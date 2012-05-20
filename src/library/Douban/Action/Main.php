<?PHP
class Douban_Action_Main extends Douban_Action_Abstract
{
	public function run()
	{
		$this->response($this->_auth);
		$this->tpl('index');
	}
}
