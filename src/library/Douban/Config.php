<?PHP   
class Douban_Config extends Su_Config
{ 
	protected function __construct()
	{   
		/**
		 *  配置信息开始       
		 */

		$this->data = $conf;   
	}

	/**
	 * single 单例调用的实现   
	 */ 
	public static function single() 
	{ 
		static $instance;      
		return $instance ? $instance : ($instance = new self());
	} 
}
