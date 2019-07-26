<?php
namespace App\Services\Switchs;

use Doctrine\ORM\EntityManager;
use Monolog\Logger;
use App\Entity\Redes\Switchs;
use App\Services\Fast\SwitchDetails;

class SwitchStatus
{
    private $objEntityManager   = NULL;
    private $objLogger          = NULL;
    
    public function __construct(EntityManager $objEntityManager, Logger $objLogger)
    {
        $this->objEntityManager = $objEntityManager;
        $this->objLogger = $objLogger;
    }
    
    
    public function status(int $idSwitch)
    {
        try {
            $objRepositorySwitchs = $this->objEntityManager->getRepository('AppEntity:Redes\Switchs');
            $objSwitch = $objRepositorySwitchs->find($idSwitch);
            if(!($objSwitch instanceof Switchs)){
                throw new \Exception("Switch id '{$idSwitch}' not found.");
            }
            
            $objSwitchDetails = new SwitchDetails($objSwitch);
            
//             \Doctrine\Common\Util\Debug::dump($objSwitchDetails->getPortDesc());
//             \Doctrine\Common\Util\Debug::dump($objSwitchDetails->getAdminStatus());
            \Doctrine\Common\Util\Debug::dump($objSwitchDetails->getOperStatus());
            //             \Doctrine\Common\Util\Debug::dump(snmpwalk('192.168.61.254', "stechtelecom","1.3.6.1.2.1.31.1.1.1.18"));
        } catch (\RuntimeException $e){
            throw $e;
        } catch (\Exception $e){
            throw $e;
        }
        return $this;
    }
}

