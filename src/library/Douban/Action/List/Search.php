<?PHP
class Douban_Action_List_Search extends Douban_Action_Abstract
{
	public function run()
	{
		$request = $this->filter();
		$list = $this->service('List_Search', $request);
		$this->setResponse(array('data' => $list));
	}
	
	private function filter()
	{
		$request['query'] = (string) $this->request->filter('query', FILTER_SANITIZE_STRING);
		return $request;
	}
}
