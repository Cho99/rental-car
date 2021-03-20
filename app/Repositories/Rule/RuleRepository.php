<?php

namespace App\Repositories\Rule;

use App\Models\Rule;
use App\Repositories\BaseRepository;

class RuleRepository extends BaseRepository implements RuleRepositoryInterface
{
    public function getModel()
    {
        return Rule::class;
    }
}
