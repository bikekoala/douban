<?PHP   
class Douban_Config extends Su_Config
{ 
	protected function __construct()
	{   
		/**
		 *  douban auth info
		 */
		$conf['auth']['api'] = 'http://www.douban.com/j/app/login';
		$conf['auth']['app'] = 'radio_android';
		$conf['auth']['ver'] = '590';

		/**
		 * music list
		 */
		$conf['list']['liked'] = 'http://www.douban.com/j/app/radio/liked_songs';
		$conf['list']['max'] = 5000;

		/**
		 * mysql
		 */
		$conf['pdo'] = 'mysql://root@10.0.0.24:3306?dbname=douban';

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
