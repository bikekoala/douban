<?PHP
class Douban_Action_Song_Download extends Douban_Action_Abstract
{
	public function run()
	{
		set_time_limit(0);
		$real = "http://10.10.4.8/download/14180317/15822691/3/mp3/151/102/1340964556951_870/14941552144000.mp3";
		$real = "http://dev.moxiu.net/~sunxuewu/SunshineGirl.mp3";
		$real = '/home/sunxuewu/public_html/SunshineGirl.mp3';

		$request = $this->request();
		//file_put_contents('/tmp/sx5.txt', var_export($_SERVER, true), FILE_APPEND);
		$this->run2($real);
	}

	public function run2($real)
	{
		$file = "sunshine.mp3";
		$fp = fopen($real,'rb');
		//$header = get_headers($real, 1);
		//$size = $header['Content-Length'];
		$size = 3729863;
		$size2 = $size-1;

		if(isset($_SERVER['HTTP_RANGE'])) {
			preg_match('/^bytes=([0-9]+)-$/i', $_SERVER['HTTP_RANGE'], $match);
			$start = $match[1];
			header('HTTP /1.1 206 Partial Content');
			header('Content-Length:'. $size);
			header('Content-Range: bytes '. $start .'-'. $size2 .'/'. $size);
			fseek($fp, $start);
			$stream = fread($fp, 10000);
			file_put_contents('/tmp/sx6.txt', $stream, FILE_APPEND);
			fclose($fp);
		} else {
			header('Content-Length:'.$size);
			header('Content-Range: bytes 0-'. $size2 .'/'. $size);
		}
		header('Accenpt-Ranges: bytes');
		header('application/octet-stream');
		header("Cache-control: public");
		header("Pragma: public");
		header('Content-Type: audio/mpeg');
		header('Content-Disposition: attachment;filename='.$file); 
		//fpassthru($fp);
		exit;
	}

	public function run3($real)
	{
		$file = "sunshine.mp3";
		$fp = fopen($real,'rb');
		//$header = get_headers($real, 1);
		//$size = $header['Content-Length'];
		$size = 3729863;
		$size2 = $size-1;

		if(isset($_SERVER['HTTP_RANGE'])) {
			preg_match('/^bytes=([0-9]+)-([0-9]*)$/i', $_SERVER['HTTP_RANGE'], $match);
			$start = $match[1];
			$end = $match[2];
			header('HTTP /1.1 206 Partial Content');
			header('Content-Length:'. $size);
			header('Content-Range: bytes '. $start .'-'. $end .'/'. $size);
			fseek($fp, $start);
			$stream = fread($fp, $end-$start);
			file_put_contents('/tmp/sx6.txt', $stream, FILE_APPEND);
			fclose($fp);
		} else {
			header('Content-Length:'.$size);
			header('Content-Range: bytes 0-'. $size2 .'/'. $size);
		}
		header('Accenpt-Ranges: bytes');
		header('application/octet-stream');
		header("Cache-control: public");
		header("Pragma: public");
		header('Content-Type: audio/mpeg');
		header('Content-Disposition: attachment;filename='.$file); 
		exit;
		//fpassthru($fp);
	}

	public function request()
	{
		$headers = array();
		foreach ($_SERVER as $key => $value) {
			if ('HTTP_' == substr($key, 0, 5)) {
				$headers[str_replace('_', '-', substr($key, 5))] = $value;
			}
		}
		if (isset($_SERVER['PHP_AUTH_DIGEST'])) {
			$headers['AUTHORIZATION'] = $_SERVER['PHP_AUTH_DIGEST'];
		} elseif (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
			$headers['AUTHORIZATION'] = base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $_SERVER['PHP_AUTH_PW']);
		}
		if (isset($_SERVER['CONTENT_LENGTH'])) {
			$headers['CONTENT-LENGTH'] = $_SERVER['CONTENT_LENGTH'];
		}
		if (isset($_SERVER['CONTENT_TYPE'])) {
			$headers['CONTENT-TYPE'] = $_SERVER['CONTENT_TYPE'];
		}
		return $headers;
	}
}
