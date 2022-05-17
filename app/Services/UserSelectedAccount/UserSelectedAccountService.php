<?php
namespace App\Services\UserSelectedAccount;

use App\Services\CRUDService;
use App\UserSelectedAccount;

class UserSelectedAccountService extends CRUDService
{
    public function __construct()
    {
        parent::__construct(UserSelectedAccount::class);
    }
}
