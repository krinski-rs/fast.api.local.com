<?php
namespace App\DBAL\Type\Enum\Redes;

use App\DBAL\Type\Enum\AbstractEnumType;

final class PortTypeType extends AbstractEnumType
{
    const FE    = 'FE';
    const GE    = 'GE';
    const GE10  = '10GE';
    
    /**
     * {@inheritdoc}
     */
    protected $name = 'redes.port_type';
    
    /**
     * {@inheritdoc}
     */
    protected static $choices = [
        1 => self::FE,
        2 => self::GE,
        3 => self::GE10
    ];
}

