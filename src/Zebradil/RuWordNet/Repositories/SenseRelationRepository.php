<?php

namespace Zebradil\RuWordNet\Repositories;

use Zebradil\RuWordNet\Models\SenseRelation;
use Zebradil\SilexDoctrineDbalModelRepository\AbstractRepository;

/**
 * Class SenseRelationRepository.
 */
class SenseRelationRepository extends AbstractRepository
{
    const TABLE_NAME = 'sense_relations';
    const MODEL_CLASS = SenseRelation::class;
    const PRIMARY_KEY = ['parent_id', 'child_id', 'name'];
}
