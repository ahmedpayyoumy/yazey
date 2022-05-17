<?php
namespace App\Services\SocialAccount;

use App\Services\CRUDService;
use App\SocialAccount;
use App\DataSource;

class SocialAccountService extends CRUDService
{
    public function __construct()
    {
        parent::__construct(SocialAccount::class);
    }

    public function query()
    {
        return $this->getModel()->whereHas('data_source');
    }

    public function queryBySource($source)
    {
        return $this->getModel()->whereHas('data_source', function ($q) use ($source) {
            $q->where('data_sources.id', $source);
        });
    }

    public function listBySource($source, $conditions = [])
    {
        return $this->getModel()->whereHas('data_source', function ($q) use ($source) {
            $q->where('data_sources.id', $source);
        })->where($conditions)->get();
    }

    public function firstBySource($source, $conditions = [])
    {
        return $this->getModel()->whereHas('data_source', function ($q) use ($source) {
            $q->where('data_sources.id', $source);
        })->where($conditions)->first();
    }

    public function listChatPlatforms()
    {
        return $this->getModel()->whereHas('data_source', function ($q) {
            $q->whereIn('data_sources.id', DataSource::CHAT_PLATFORMS);
        })->get();
    }
}
