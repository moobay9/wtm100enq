<?php
class Model_Enquete extends \Orm\Model
{
    protected static $_properties = [
        'id',
        'name',
        'best',
        'remarks',
        'created_at',
        'updated_at',
    ];

    protected static $_observers = [
        'Orm\Observer_CreatedAt' => [
            'events' => ['before_insert'],
            'mysql_timestamp' => false,
        ],
        'Orm\Observer_UpdatedAt' => [
            'events' => ['before_save'],
            'mysql_timestamp' => false,
        ],
    ];

    protected static $_table_name = 'enquetes';
}
