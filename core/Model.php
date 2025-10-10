<?php

namespace core;

use components\DB;

/**
 * This is a class for all models
 * Currently it is empty, due to time constraints
 * But here we would add some methods that are universal for all models
 * e.g. all(), findOneById(), count()
 */
class Model extends DB
{
    public function __construct()
    {
        parent::__construct();
    }
}