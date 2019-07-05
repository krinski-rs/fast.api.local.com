<?php
namespace App\DBAL\Type\Enum\Redes;

use App\DBAL\Type\Enum\AbstractEnumType;

final class PortModeType extends AbstractEnumType
{
    const ACCESS        = 'ACCESS';
    const TRUNK         = 'TRUNK';
    const DYNAMIC       = 'DYNAMIC';
    const DESIRABLE     = 'DESIRABLE';
    const AUTO_MODES    = 'AUTO MODES';
    
    /**
     * {@inheritdoc}
     */
    protected $name = 'redes.port_mode';
    
    /**
     * {@inheritdoc}
     */
    protected static $choices = [
        0 => self::ACCESS,
        1 => self::TRUNK,
        2 => self::DYNAMIC,
        3 => self::DESIRABLE,
        4 => self::AUTO_MODES
    ];
}

