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
    public function repo(string $repo, string $account = null)
    {
        if (!$requestedAccount = $this->resolveAccount($account)) {
            return;
        }

        return (array) self::$repo->show($requestedAccount, $repo);
    }

    /**
     * Get issues.
     *
     * @return array
     */
    public function openIssues(string $repo, string $account = null)
    {
        if (!$requestedAccount = $this->resolveAccount($account)) {
            return;
        }

        return self::$issues->all($repo, $requestedAccount);
    }

    /**
     * Parse request for account.
     *
     * @param  string $account
     * @return string
     */
    protected function resolveAccount(string $account = null)
    {
        if (isset($account)) {
            return $account;
        } elseif (!is_null($this->getAccount())) {
            return $this->getAccount();
        }
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
