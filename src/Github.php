<?php

namespace TinyPixel\Acorn\Github;

use \Exception;
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
     * Repo API
     * @var
     */
    protected static $repo;

    /**
     * "Me" API (account)
     * @var
     */
    protected static $me;

    /**
     * Issues API
     * @var
     */
    protected static $issues;

    /**
     * Account
     * @var string
     */
    protected $account;

    /**
     * Class constructor.
     *
     * @param \GrahamCampbell\Github\GithubManager $github
     */
    public function __construct(GithubManager $github)
    {
        self::$api    = $github;
        self::$repo   = $github->repo();
        self::$me     = $github->me();
        self::$issues = $github->issues();
    }

    /**
     * Get account information.
     *
     * @return array
     */
    public function repo(string $repo, string $account = null) : array
    {
        return self::$repo->show($this->resolveAccount($account), $repo);
    }

    /**
     * Get issues.
     *
     * @return array
     */
    public function openIssues(string $repo, string $account = null) : array
    {
        return self::$issues->all($repo, $this->resolveAccount($account));
    }

    /**
     * Parse request for account.
     *
     * @param  string $account
     * @return string
     */
    protected function resolveAccount(string $account = null) : string
    {
        if (isset($account)) {
            return $account;
        } elseif (!is_null($this->getAccount())) {
            return $this->getAccount();
        }

        throw new Exception('Github account not preset or specified.');
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
     * Get account.
     *
     * @return string
     */
    protected function getAccount() : string
    {
        return $this->account;
    }
}
