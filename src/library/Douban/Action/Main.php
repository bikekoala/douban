<?PHP
class Douban_Action_Main extends Douban_Action_Abstract
{
	public function run()
	{
		$this->setResponse($this->auth);
		$this->tpl('index');
		$this->format(Su_Const::FT_HTML);
	}
}
