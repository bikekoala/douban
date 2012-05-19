<?PHP
class Douban_Action_Abstract extends Su_Ctrl_Action
{
	public function execute()
	{
		$this->run();
		$this->format(Su::FT_JSON);
	}
}
