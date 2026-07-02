<?php

namespace Cooperl\DB2\Database\Schema\Grammars;

class DB2ExpressCGrammar extends DB2Grammar
{
    /**
     * Compile the query to determine the list of tables.
     *
     * @return string
     */
    public function compileTableExists($schema = null, $table = null)
    {
        return sprintf(
            "select count(*) as \"exists\" from syspublic.all_tables where table_schema = upper('%s') and table_name = upper('%s')",
            $schema,
            $table
        );
    }

    /**
     * Compile the query to determine the list of columns.
     *
     * @return string
     */
    public function compileColumnExists()
    {
        return 'select column_name from syspublic.all_ind_columns where table_schema = upper(?) and table_name = upper(?)';
    }
}
