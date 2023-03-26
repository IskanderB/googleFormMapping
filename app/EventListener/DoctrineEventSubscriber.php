<?php

namespace App\EventListener;

use Doctrine\Common\EventSubscriber as Subscriber;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Event\ConnectionEventArgs;
use Doctrine\DBAL\Events;
use Doctrine\DBAL\Types\Type;

class DoctrineEventSubscriber implements Subscriber
{
    public function getSubscribedEvents(): array
    {
        return [
            Events::postConnect,
        ];
    }

    /**
     * @throws DBALException
     */
    public function postConnect(ConnectionEventArgs $args): void
    {
        if (!Type::hasType('bool[]')) {
            Type::addType('bool[]', \MartinGeorgiev\Doctrine\DBAL\Types\BooleanArray::class);
        }
        if (!Type::hasType('bigint[]')) {
            Type::addType('bigint[]', \MartinGeorgiev\Doctrine\DBAL\Types\BigIntArray::class);
        }
        if (!Type::hasType('integer[]')) {
            Type::addType('integer[]', \MartinGeorgiev\Doctrine\DBAL\Types\IntegerArray::class);
        }
        if (!Type::hasType('smallint[]')) {
            Type::addType('smallint[]', \MartinGeorgiev\Doctrine\DBAL\Types\SmallIntArray::class);
        }
        if (!Type::hasType('text[]')) {
            Type::addType('text[]', \MartinGeorgiev\Doctrine\DBAL\Types\TextArray::class);
        }
        if (!Type::hasType('jsonb')) {
            Type::addType('jsonb', \MartinGeorgiev\Doctrine\DBAL\Types\Jsonb::class);
        }
        if (!Type::hasType('jsonb[]')) {
            Type::addType('jsonb[]', \MartinGeorgiev\Doctrine\DBAL\Types\JsonbArray::class);
        }
    }
}
