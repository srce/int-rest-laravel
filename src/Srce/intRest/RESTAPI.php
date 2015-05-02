<?php namespace Srce\intRest;

class RESTAPI {

        protected $restUser;
        protected $restPwd;
        protected $restHost;
        protected $restCacheMinutes;

        public function __construct($user, $pwd, $host, $minutes)
        {
                $this->restUser = $user;
                $this->restPwd = $pwd;
                $this->restHost = $host;
                $this->restCacheMinutes = $minutes;
        }
}
