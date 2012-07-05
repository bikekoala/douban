<?PHP
class Douban_Action_Main extends Douban_Action_Abstract
{
	public function run()
	{
		if ($this->auth['auth']) {
			$this->setResponse($this->auth);
			$this->tpl('player_fm');
		} else {
			$this->tpl('logon');
		}
		$this->format(Su_Const::FT_HTML);
	}
}
