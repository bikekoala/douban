<?PHP
class Douban_Action_Main extends Douban_Action_Abstract
{
	public function run()
	{
		$this->response('isAuth', $this->_isAuth);
		$this->tpl('index');
	}
}
