<?php
namespace App\Services\Industry;

use App\Services\CRUDService;
use App\Industry;

class IndustryService extends CRUDService
{
    public function __construct()
    {
        parent::__construct(Industry::class);
    }
}
