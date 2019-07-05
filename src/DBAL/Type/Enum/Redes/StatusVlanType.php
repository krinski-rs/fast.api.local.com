<?php
namespace App\DBAL\Type\Enum\Redes;

use App\DBAL\Type\Enum\AbstractEnumType;

final class StatusVlanType extends AbstractEnumType
{
    const LIVRE         = 'LIVRE';
    const EM_USO        = 'EM USO';
    const RESERVADA     = 'RESERVADA';
    const TEMPORARIA    = 'TEMPORÁRIA';
    
    /**
     * {@inheritdoc}
     */
    protected $name = 'redes.status_vlan';
    
    /**
     * {@inheritdoc}
     */
    protected static $choices = [
        0 => self::LIVRE,
        1 => self::EM_USO,
        2 => self::RESERVADA,
        3 => self::TEMPORARIA
    ];
}

