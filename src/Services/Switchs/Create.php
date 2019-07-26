<?php
namespace App\Services\Switchs;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;
use Doctrine\ORM\EntityManager;
use Monolog\Logger;
use App\Entity\Redes\Switchs;
use App\Entity\Redes\SwitchModel;
use App\Entity\Redes\SwitchModelPort;
use App\Entity\Redes\Port;
use App\DBAL\Type\Enum\Redes\PortTypeType;

class Create
{
    private $objEntityManager   = NULL;
    private $objSwitchs         = NULL;
    private $objLogger          = NULL;
    private $objPop             = NULL;
    private $objVlan            = NULL;
    private $objSwitchModel     = NULL;
    
    public function __construct(EntityManager $objEntityManager, Logger $objLogger)
    {
        $this->objEntityManager = $objEntityManager;
        $this->objLogger = $objLogger;
    }
    
    private function addPort(){
        try {
            $types = PortTypeType::getChoices();
            $arraySwitchModelPort = $this->objSwitchs->getSwitchModel()->getSwitchModelPort();
            if($arraySwitchModelPort->count()){
                reset($arraySwitchModelPort);
                while($objSwitchModelPort = $arraySwitchModelPort->current()){
                    if($objSwitchModelPort instanceof SwitchModelPort){
                        $type = $objSwitchModelPort->getPortType();
                        $quantities = $objSwitchModelPort->getQuantities();
                        $ini = 1;
                        while($ini <= $quantities){
                            $objPort = new Port();
//                             $objPort->setAdminStatus($adminStatus);
                            $objPort->setAutoNeg(TRUE);
//                             $objPort->setDestiny($destiny);
//                             $objPort->setDuplex($duplex);
                            $objPort->setFlowCtrl(FALSE);
                            $objPort->setMode(0);
                            $objPort->setNumbering($ini);
//                             $objPort->setOperStatus($operStatus);
//                             $objPort->setSpeed($speed);
//                             $objPort->setSwitchs($switchs);
                            $objPort->setType($types[$type]);
//                             $objPort->setVlan($vlan);
                            $this->objSwitchs->addPort($objPort);
                            $ini++;
                        }
                    }
                    $arraySwitchModelPort->next();
                }
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function create(Request $objRequest)
    {
        try {
            $this->validate($objRequest);
            $this->objSwitchs = new Switchs();
            $this->objSwitchs->setActive(TRUE);
            
            if(trim($objRequest->get('address_ipv4', NULL))){
                $this->objSwitchs->setAddressIpv4(trim($objRequest->get('address_ipv4', NULL)));
            }
            
            if(trim($objRequest->get('address_ipv6', NULL))){
                $this->objSwitchs->setAddressIpv6(trim($objRequest->get('address_ipv6', NULL)));
            }
            
            $this->objSwitchs->setCreatedAt(new \DateTime());
            
            if(trim($objRequest->get('name', NULL))){
                $this->objSwitchs->setName(trim($objRequest->get('name', NULL)));
            }
            
            if(trim($objRequest->get('password', NULL))){
                $this->objSwitchs->setPassword(trim($objRequest->get('password', NULL)));
            }
            
            $this->objSwitchs->setPop($this->objPop);
            $this->objSwitchs->setRemovedAt(NULL);
            $this->objSwitchs->setSwitchModel($this->objSwitchModel);
                        
            if(trim($objRequest->get('username', NULL))){
                $this->objSwitchs->setUsername(trim($objRequest->get('username', NULL)));
            }
                        
            if(trim($objRequest->get('community', NULL))){
                $this->objSwitchs->setCommunity(trim($objRequest->get('community', NULL)));
            }
            
            $this->objSwitchs->setVlan($this->objVlan);
            $this->addPort();
        } catch (\RuntimeException $e){
            throw $e;
        } catch (\Exception $e){
            throw $e;
        }
        return $this;
    }
    
    private function validate(Request $objRequest)
    {
        $objNotNull = new Assert\NotNull();
        $objNotNull->message = 'Esse valor não deve ser nulo.';
        $objNotBlank = new Assert\NotBlank();
        $objNotBlank->message = 'Esse valor não deve estar em branco.';
        
        $objLength = new Assert\Length(
            [
                'min' => 2,
                'max' => 255,
                'minMessage' => 'O campo deve ter pelo menos {{ limit }} caracteres.',
                'maxMessage' => 'O campo não pode ser maior do que {{ limit }} caracteres.'
            ]
        );
        
        $objInt = new Assert\Type(
            [
                'message' => 'Este valor deve ser do tipo {{ type }}',
                'type' => 'numeric'
            ]
        );
        
        $objIpv4 = new Assert\Ip(
            [
                'message' => 'Este não é um endereço IP válido.',
                'version' => 4
            ]
        );
        
        $objIpv6 = new Assert\Ip(
            [
                'message' => 'Este não é um endereço IP válido.',
                'version' => 6
            ]
        );
        
        $objRecursiveValidator = Validation::createValidatorBuilder()->getValidator();
        
        $objCollection = new Assert\Collection(
            [
                'fields' => [
                    'address_ipv4' =>   new Assert\Optional(
                        [
                            $objIpv4
                        ]
                    ),
                    'address_ipv6' =>  new Assert\Optional(
                        [
                            $objIpv6
                        ]
                    ),
                    'name' => new Assert\Required(
                        [
                            $objNotNull,
                            $objNotBlank,
                            $objLength
                        ]
                    ),
                    'password' =>   new Assert\Optional(
                        [
                            $objLength
                        ]
                    ),
                    'pop' => new Assert\Optional(
                        [
                            $objNotNull,
                            $objNotBlank,
                            $objInt
                        ]
                    ),
                    'vlan' => new Assert\Optional(
                        [
                            $objNotNull,
                            $objNotBlank,
                            $objInt
                        ]
                    ),
                    'switch_model' => new Assert\Required(
                        [
                            $objNotNull,
                            $objNotBlank,
                            $objInt
                        ]
                    ),
                    'username' => new Assert\Optional(
                        [
                            $objLength
                        ]
                    )
                ]
            ]
        );
        $data = [
            'address_ipv4'  => trim($objRequest->get('address_ipv4', NULL)),
            'address_ipv6'  => trim($objRequest->get('address_ipv6', NULL)),
            'name'  => trim($objRequest->get('name', NULL)),
            'password'  => trim($objRequest->get('password', NULL)),
            'pop'  => trim($objRequest->get('pop', NULL)),
            'switch_model'  => trim($objRequest->get('switch_model', NULL)),
            'username'  => trim($objRequest->get('username', NULL)),
            'vlan'  => trim($objRequest->get('vlan', NULL))
        ];
                
        $objConstraintViolationList = $objRecursiveValidator->validate($data, $objCollection);
        
        if($objConstraintViolationList->count()){
            $objArrayIterator = $objConstraintViolationList->getIterator();
            $objArrayIterator->rewind();
            $mensagem = '';
            while($objArrayIterator->valid()){
                if($objArrayIterator->key()){
                    $mensagem.= "\n";
                }
                $mensagem.= $objArrayIterator->current()->getPropertyPath().': '.$objArrayIterator->current()->getMessage();
                $objArrayIterator->next();
            }
            throw new \RuntimeException($mensagem);
        }
        
        if($objRequest->get('vlan', NULL)){
            $this->objVlan = $this->objEntityManager->getRepository('AppEntity:Redes\Vlan')->find($objRequest->get('vlan', NULL));
        }
        
        if($objRequest->get('pop', NULL)){
            $this->objPop = $this->objEntityManager->getRepository('AppEntity:Redes\Pop')->find($objRequest->get('pop', NULL));
        }
        
        $this->objSwitchModel = $this->objEntityManager->getRepository('AppEntity:Redes\SwitchModel')->find(trim($objRequest->get('switch_model', NULL)));
    }
    
    public function save()
    {
        $this->objEntityManager->persist($this->objSwitchs);
        $this->objEntityManager->flush();
        return $this->objSwitchs;
    }
}

