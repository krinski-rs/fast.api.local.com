<?php
namespace App\Services\Fast;

use App\Entity\Redes\Switchs as EntitySwitchs;

class SwitchDetails
{
    private $objSwitch = NULL;
    private $objSNMP = NULL;
    
    const PORT_DESC     = '1.3.6.1.2.1.31.1.1.1.18';
    const ADMIN_STATUS  = '1.3.6.1.2.1.2.2.1.7';
    const OPER_STATUS   = '1.3.6.1.2.1.2.2.1.8';
    
    public function __construct(EntitySwitchs $objSwitch)
    {
        try {
            $this->objSwitch = $objSwitch;
            $this->objSNMP = new \SNMP(\SNMP::VERSION_1, $this->objSwitch->getAddressIpv4(), $this->objSwitch->getCommunity());
            print_r($this->objSNMP->getError());
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function getPortDesc()
    {
        return $this->objSNMP->walk(self::PORT_DESC);
    }
    
    public function getAdminStatus()
    {
        return $this->objSNMP->walk(self::ADMIN_STATUS);
    }
    
    public function getOperStatus()
    {
        return $this->objSNMP->walk(self::OPER_STATUS);
    }
    
    public function __destruct()
    {
        if($this->objSNMP instanceof \SNMP){
            $this->objSNMP->close();
        }
    }
}
