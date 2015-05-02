<?php namespace Srce;

class IntRest {

	protected $restUser;
	protected $restPwd;
	protected $restHost;
	protected $restCacheMinutes;

	public function __construct($user, $pwd, $host, $minutes = 10)
	{
		$this->restUser = $user;
		$this->restPwd = $pwd;
		$this->restHost = $host;
		$this->restCacheMinutes = $minutes;
	}

	public function getOrg($query)
	{
		return $this->get('org', $query);
	}

	public function getPP($query)
	{
		return $this->get('pp', $query);
	}

	public function getFin($query)
	{
		return $this->get('fin', $query);
	}

	public function getLDAP($query)
	{
		return $this->get('ldap', $query);
	}

	public function get($type, $query)
	{
		return $this->getFull($type.'/'.$query, $type.'.'.$query);
	}

	/**
	 * @param string $partial_url
	 * @param string $cache_key
	 * @param bool $raw
	 * @return array of JSON data
	 */
	public function getFull($partial_url, $cache_key, $raw = false)
	{
		if (\Cache::has($cache_key)){
			$json = \Cache::get($cache_key);
		} else {
			$url = 'https://'.
				$this->restUser.
				':'.
				$this->restPwd.
				'@'.
				$this->nvl($this->restHost, 'int-rest').
				'.srce.hr/v1/'.
				$partial_url;
			$json = @file_get_contents($url);
			if ($json === false){
				$json = array('error' => "Resource ".$partial_url." not found.");
			} else {
				if ($raw === false){
					$json = json_decode($json, true);
				}
			}
			\Cache::put($cache_key, $json, $this->nvl($this->restCacheMinutes, 10));
		}

		return $json;
	}

	protected function nvl($value, $default = null)
	{
		if ($value == ''){
			return $default;
		}
		return $value;
	}
}
