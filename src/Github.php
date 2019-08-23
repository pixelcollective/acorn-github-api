<?php

namespace TinyPixel\Acorn\Github;

use GrahamCampbell\Github\GithubManager;

/**
 * Github
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class Github
{
    /**
     * Github
     * @var \GrahamCampbell\Github\GithubManager
     */
    protected static $api;

    /**
     * Account
     * @var string
     */
    protected $account;

    /**
     * API pluralizations
     * @var array
     */
    protected static $apiInflection = [
    ];

    /**
     * Class constructor.
     *
     * @param \GrahamCampbell\Github\GithubManager $github
     */
    public function __construct(GithubManager $github)
    {
        self::$api  = $github;
        self::$repo = $github::repo();
        self::$me   = $github::me();
    }

    /**
     * Set account.
     *
     * @param  string $account
     * @return void
     */
    public function setAccount(string $account) : void
    {
        $this->account = $account;
    }

    /**
     * Get account information.
     *
     * @return array
     */
    public function repo(string $repo)
    {
        return self::$repo->show('kellymears', $repo);
    }
}
