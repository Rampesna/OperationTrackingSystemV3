<?php

namespace App\Services\Gitlab;

use GrahamCampbell\GitLab\Facades\GitLab;

abstract class GitlabService
{
    /**
     * @var $gitlabClient
     */
    private $gitlabClient;

    public function __construct()
    {
        $this->gitlabClient = GitLab::connection('main');
    }

    public function gitlabClient()
    {
        return $this->gitlabClient;
    }
}
