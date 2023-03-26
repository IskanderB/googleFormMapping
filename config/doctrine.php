<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Entity Managers
    |--------------------------------------------------------------------------
    |
    | Configure your Entity Managers here. You can set a different connection
    | and driver per manager and configure events and filters. Change the
    | paths setting to the appropriate path and replace App namespace
    | by your own namespace.
    |
    | Available meta drivers: fluent|annotations|yaml|simplified_yaml|xml|simplified_xml|config|static_php|php
    |
    | Available connections: mysql|oracle|pgsql|sqlite|sqlsrv
    | (Connections can be configured in the database config)
    |
    | Depending on the chosen database connection, various other settings are
    | available. Check the available settings for your connection type in
    | the LaravelDoctrine\ORM\Configuration\Connections namespace.
    |
    | --> Warning: Proxy auto generation should only be enabled in dev!
    |
    */
    'managers'                   => [
        'default' => [
            'dev'           => env('APP_DEBUG', false),
            'meta'          => env('DOCTRINE_METADATA', 'attributes'),
            'connection'    => env('DB_CONNECTION', 'pgsql'),
            'namespaces'    => [],
            'paths'         => [
                base_path('app/Entity')
            ],
            'repository'    => Doctrine\ORM\EntityRepository::class,
            'proxies'       => [
                'namespace'     => false,
                'path'          => storage_path('proxies'),
                'auto_generate' => env('DOCTRINE_PROXY_AUTOGENERATE', false)
            ],
            /*
            |--------------------------------------------------------------------------
            | Doctrine events
            |--------------------------------------------------------------------------
            |
            | The listener array expects the key to be a Doctrine event
            | e.g. Doctrine\ORM\Events::onFlush
            |
            */
            'events'        => [
                'listeners'   => [],
                'subscribers' => []
            ],
            'filters'       => [],
            /*
            |--------------------------------------------------------------------------
            | Doctrine mapping types
            |--------------------------------------------------------------------------
            |
            | Link a Database Type to a Local Doctrine Type
            |
            | Using 'enum' => 'string' is the same of:
            | $doctrineManager->extendAll(function (\Doctrine\ORM\Configuration $configuration,
            |         \Doctrine\DBAL\Connection $connection,
            |         \Doctrine\Common\EventManager $eventManager) {
            |     $connection->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
            | });
            |
            | References:
            | https://www.doctrine-project.org/projects/doctrine-orm/en/current/cookbook/custom-mapping-types.html
            | https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/types.html#custom-mapping-types
            | https://www.doctrine-project.org/projects/doctrine-orm/en/current/cookbook/advanced-field-value-conversion-using-custom-mapping-types.html
            | https://www.doctrine-project.org/projects/doctrine-orm/en/current/reference/basic-mapping.html
            | https://symfony.com/doc/current/doctrine/dbal.html#registering-custom-mapping-types-in-the-schematool
            |--------------------------------------------------------------------------
            */
            'mapping_types' => [
                //'enum' => 'string',
                '_bool' => 'bool[]',
                'bool[]' => 'bool[]',
                '_int2' => 'smallint[]',
                'smallint[]' => 'smallint[]',
                '_int4' => 'integer[]',
                'integer[]' => 'integer[]',
                '_int8' => 'bigint',
                'bigint[]' => 'bigint[]',
                '_text' => 'text[]',
                'text[]' => 'text[]',
                'jsonb' => 'jsonb',
                '_jsonb' => 'jsonb[]',
                'jsonb[]' => 'jsonb[]',
            ]
        ]
    ],
    /*
    |--------------------------------------------------------------------------
    | Doctrine Extensions
    |--------------------------------------------------------------------------
    |
    | Enable/disable Doctrine Extensions by adding or removing them from the list
    |
    | If you want to require custom extensions you will have to require
    | laravel-doctrine/extensions in your composer.json
    |
    */
    'extensions'                 => [
        //LaravelDoctrine\ORM\Extensions\TablePrefix\TablePrefixExtension::class,
        //LaravelDoctrine\Extensions\Timestamps\TimestampableExtension::class,
        //LaravelDoctrine\Extensions\SoftDeletes\SoftDeleteableExtension::class,
        //LaravelDoctrine\Extensions\Sluggable\SluggableExtension::class,
        //LaravelDoctrine\Extensions\Sortable\SortableExtension::class,
        //LaravelDoctrine\Extensions\Tree\TreeExtension::class,
        //LaravelDoctrine\Extensions\Loggable\LoggableExtension::class,
        //LaravelDoctrine\Extensions\Blameable\BlameableExtension::class,
        //LaravelDoctrine\Extensions\IpTraceable\IpTraceableExtension::class,
        //LaravelDoctrine\Extensions\Translatable\TranslatableExtension::class
    ],
    /*
    |--------------------------------------------------------------------------
    | Doctrine custom types
    |--------------------------------------------------------------------------
    |
    | Create a custom or override a Doctrine Type
    |--------------------------------------------------------------------------
    */
    'custom_types'               => [
        'uuid' => 'Ramsey\Uuid\Doctrine\UuidType',
        'bool[]' => MartinGeorgiev\Doctrine\DBAL\Types\BooleanArray::class,
        'bigint[]' => MartinGeorgiev\Doctrine\DBAL\Types\BigIntArray::class,
        'integer[]' => MartinGeorgiev\Doctrine\DBAL\Types\IntegerArray::class,
        'smallint[]' => MartinGeorgiev\Doctrine\DBAL\Types\SmallIntArray::class,
        'text[]' => MartinGeorgiev\Doctrine\DBAL\Types\TextArray::class,
        'jsonb' => MartinGeorgiev\Doctrine\DBAL\Types\Jsonb::class,
        'jsonb[]' => MartinGeorgiev\Doctrine\DBAL\Types\JsonbArray::class,
    ],
    /*
    |--------------------------------------------------------------------------
    | DQL custom datetime functions
    |--------------------------------------------------------------------------
    */
    'custom_datetime_functions'  => [],
    /*
    |--------------------------------------------------------------------------
    | DQL custom numeric functions
    |--------------------------------------------------------------------------
    */
    'custom_numeric_functions'   => [],
    /*
    |--------------------------------------------------------------------------
    | DQL custom string functions
    |--------------------------------------------------------------------------
    */
    'custom_string_functions'    => [
        # alternative implementation of ALL() and ANY() where subquery is not required, useful for arrays
        'ALL_OF' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\All::class,
        'ANY_OF' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\Any::class,

        # operators for working with array and json(b) data
        'CONTAINS' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\Contains::class,
        'IS_CONTAINED_BY' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\IsContainedBy::class,
        'OVERLAPS' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\Overlaps::class,
        'GREATEST' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\Greatest::class,
        'LEAST' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\Least::class,

        # array and string specific functions
        'IN_ARRAY' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\InArray::class,
        'ARRAY' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\Arr::class,
        'ARRAY_AGG' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\ArrayAgg::class,
        'ARRAY_APPEND' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\ArrayAppend::class,
        'ARRAY_CARDINALITY' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\ArrayCardinality::class,
        'ARRAY_CAT' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\ArrayCat::class,
        'ARRAY_DIMENSIONS' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\ArrayDimensions::class,
        'ARRAY_LENGTH' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\ArrayLength::class,
        'ARRAY_NUMBER_OF_DIMENSIONS' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\ArrayNumberOfDimensions::class,
        'ARRAY_PREPEND' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\ArrayPrepend::class,
        'ARRAY_REMOVE' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\ArrayRemove::class,
        'ARRAY_REPLACE' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\ArrayReplace::class,
        'ARRAY_TO_JSON' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\ArrayToJson::class,
        'ARRAY_TO_STRING' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\ArrayToString::class,
        'STRING_AGG' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\StringAgg::class,
        'STRING_TO_ARRAY' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\StringToArray::class,
        'UNNEST' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\Unnest::class,

        # json specific functions
        'JSON_AGG' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonAgg::class,
        'JSON_ARRAY_LENGTH' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonArrayLength::class,
        'JSON_GET_FIELD' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonGetField::class,
        'JSON_GET_FIELD_AS_TEXT' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonGetFieldAsText::class,
        'JSON_GET_FIELD_AS_INTEGER' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonGetFieldAsInteger::class,
        'JSON_GET_OBJECT' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonGetObject::class,
        'JSON_GET_OBJECT_AS_TEXT' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonGetObjectAsText::class,
        'JSON_OBJECT_AGG' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonObjectAgg::class,
        'JSON_OBJECT_KEYS' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonObjectKeys::class,
        'JSON_STRIP_NULLS' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonStripNulls::class,
        'TO_JSON' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\ToJson::class,
        'ROW_TO_JSON' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\RowToJson::class,

        # jsonb specific functions
        'JSONB_AGG' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonbAgg::class,
        'JSONB_ARRAY_ELEMENTS' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonbArrayElements::class,
        'JSONB_ARRAY_ELEMENTS_TEXT' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonbArrayElementsText::class,
        'JSONB_ARRAY_LENGTH' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonbArrayLength::class,
        'JSONB_EACH' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonbEach::class,
        'JSONB_EACH_TEXT' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonbEachText::class,
        'JSONB_EXISTS' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonbExists::class,
        'JSONB_INSERT' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonbInsert::class,
        'JSONB_OBJECT_AGG' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonbObjectAgg::class,
        'JSONB_OBJECT_KEYS' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonbObjectKeys::class,
        'JSONB_PRETTY' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonbPretty::class,
        'JSONB_SET' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonbSet::class,
        'JSONB_SET_LAX' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonbSetLax::class,
        'JSONB_STRIP_NULLS' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\JsonbStripNulls::class,
        'TO_JSONB' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\ToJsonb::class,

        # text search specific
        'TO_TSQUERY' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\ToTsquery::class,
        'TO_TSVECTOR' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\ToTsvector::class,
        'TSMATCH' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\Tsmatch::class,

        # Date specific functions
        'DATE_OVERLAPS' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\DateOverlaps::class,
        'DATE_EXTRACT' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\DateExtract::class,

        # other operators
        'CAST' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\Cast::class,
        'ILIKE' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\Ilike::class,
        'SIMILAR_TO' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\SimilarTo::class,
        'NOT_SIMILAR_TO' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\NotSimilarTo::class,
        'UNACCENT' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\Unaccent::class,
        'REGEXP' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\Regexp::class,
        'IREGEXP' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\IRegexp::class,
        'NOT_REGEXP' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\NotRegexp::class,
        'NOT_IREGEXP' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\NotIRegexp::class,
        'FLAGGED_REGEXP_LIKE' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\FlaggedRegexpLike::class,
        'REGEXP_LIKE' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\RegexpLike::class,
        'FLAGGED_REGEXP_MATCH' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\FlaggedRegexpMatch::class,
        'REGEXP_MATCH' => MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\RegexpMatch::class,
    ],
    /*
    |--------------------------------------------------------------------------
    | Register custom hydrators
    |--------------------------------------------------------------------------
    */
    'custom_hydration_modes'     => [
        // e.g. 'hydrationModeName' => MyHydrator::class,
    ],
    /*
    |--------------------------------------------------------------------------
    | Enable query logging with laravel file logging,
    | debugbar, clockwork or an own implementation.
    | Setting it to false, will disable logging
    |
    | Available:
    | - LaravelDoctrine\ORM\Loggers\LaravelDebugbarLogger
    | - LaravelDoctrine\ORM\Loggers\ClockworkLogger
    | - LaravelDoctrine\ORM\Loggers\FileLogger
    |--------------------------------------------------------------------------
    */
    'logger'                     => env('DOCTRINE_LOGGER', false),
    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | Configure meta-data, query and result caching here.
    | Optionally you can enable second level caching.
    |
    | Available: apc|array|file|illuminate|memcached|php_file|redis|void
    |
    */
    'cache' => [
        'second_level'     => false,
        'default'          => env('DOCTRINE_CACHE', 'array'),
        'namespace'        => null,
        'metadata'         => [
            'driver'       => env('DOCTRINE_METADATA_CACHE', env('DOCTRINE_CACHE', 'array')),
            'namespace'    => null,
        ],
        'query'            => [
            'driver'       => env('DOCTRINE_QUERY_CACHE', env('DOCTRINE_CACHE', 'array')),
            'namespace'    => null,
        ],
        'result'           => [
            'driver'       => env('DOCTRINE_RESULT_CACHE', env('DOCTRINE_CACHE', 'array')),
            'namespace'    => null,
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Gedmo extensions
    |--------------------------------------------------------------------------
    |
    | Settings for Gedmo extensions
    | If you want to use this you will have to require
    | laravel-doctrine/extensions in your composer.json
    |
    */
    'gedmo'                      => [
        'all_mappings' => false
    ],
    /*
     |--------------------------------------------------------------------------
     | Validation
     |--------------------------------------------------------------------------
     |
     |  Enables the Doctrine Presence Verifier for Validation
     |
     */
    'doctrine_presence_verifier' => true,

    /*
     |--------------------------------------------------------------------------
     | Notifications
     |--------------------------------------------------------------------------
     |
     |  Doctrine notifications channel
     |
     */
    'notifications'              => [
        'channel' => 'database'
    ]
];
