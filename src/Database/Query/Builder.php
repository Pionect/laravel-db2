<?php

namespace Cooperl\DB2\Database\Query;

/**
 * Class Builder
 *
 * @package Cooperl\DB2\Database\Query
 */
class Builder extends \Illuminate\Database\Query\Builder
{
    /**
     * Determine if any rows exist for the current query.
     *
     * @return bool
     */
    public function exists()
    {
        $this->applyBeforeQueryCallbacks();

        $results = $this->connection->select(
            $this->grammar->compileExists($this), $this->getBindings(), ! $this->useWritePdo
        );

        // If the results have rows, we will get the row and see if the exists column is a
        // boolean true. If there are no results for this query we will return false as
        // there are no rows for this query at all, and we can return that info here.
        if (isset($results[0])) {
            $results = (array) $results[0];

            // Change the keys to lower case to make sure we can access 'exists' key
            $results = array_change_key_case($results, CASE_LOWER);

            return (bool) $results['exists'];
        }

        return false;
    }
}
