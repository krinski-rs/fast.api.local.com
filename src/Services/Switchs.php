<?php
namespace App\Services;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpFoundation\Request;
use Monolog\Logger;
use App\Entity\Redes\Switchs as EntitySwitchs;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Services\Switchs\Create;
use App\Services\Switchs\Listing;
use App\Entity\Redes\Vlan;
use App\Services\Switchs\SwitchStatus;

class Switchs
{
    private $objEntityManager   = NULL;
    private $objLogger          = NULL;
    
    public function __construct(Registry $objRegistry, Logger $objLogger)
    {
        $this->objEntityManager = $objRegistry->getManager('default');
        $this->objLogger = $objLogger;
    }
    
    public function create(Request $objRequest)
    {
        try {
            $objCreate = new Create($this->objEntityManager, $this->objLogger);
            $objTemplate = $objCreate
                ->create($objRequest)
                ->save();
            $defaultContext = [
                AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                    if($object instanceof Vlan){
                        return $object->getTagId();
                    }else{
                        return $object->getName();
                    }
                },
                AbstractNormalizer::CALLBACKS => [
                    'createdAt' => function ($dateTime) {
                        return $dateTime instanceof \DateTime ? $dateTime->format(\DateTime::ISO8601) : '';
                    },
                    'removedAt' => function ($dateTime) {
                        return $dateTime instanceof \DateTime ? $dateTime->format(\DateTime::ISO8601) : '';
                    }
                ],
            ];
            
            $objGetSetMethodNormalizer = new GetSetMethodNormalizer(NULL, NULL, NULL, NULL, NULL, $defaultContext);
            $objSerializer = new Serializer([$objGetSetMethodNormalizer]);
            return $objSerializer->normalize($objTemplate);
        } catch (\RuntimeException $e){
            throw $e;
        } catch (\Exception $e){
            throw $e;
        }
    }
    
    public function get(int $idSwitch)
    {
        try {
            $objListing = new Listing($this->objEntityManager);
            $objSwitch = $objListing->get($idSwitch);
            
            if(!($objSwitch instanceof EntitySwitchs)){
                throw new NotFoundHttpException("Not Found");
            }
            
            $defaultContext = [
                AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                    if($object instanceof Vlan){
                        return $object->getTagId();
                    }else{
                        return $object->getName();
                    }
                },
                AbstractNormalizer::CALLBACKS => [
                    'createdAt' => function ($dateTime) {
                        return $dateTime instanceof \DateTime ? $dateTime->format(\DateTime::ISO8601) : NULL;
                    },
                    'removedAt' => function ($dateTime) {
                        return $dateTime instanceof \DateTime ? $dateTime->format(\DateTime::ISO8601) : NULL;
                    },
                ],
            ];
            
            $objGetSetMethodNormalizer = new GetSetMethodNormalizer(NULL, NULL, NULL, NULL, NULL, $defaultContext);
            $objSerializer = new Serializer([$objGetSetMethodNormalizer]);
            return $objSerializer->normalize($objSwitch);
        } catch (\RuntimeException $e){
            throw $e;
        } catch (\Exception $e){
            throw $e;
        }
    }
    
    public function status(int $idSwitch)
    {
        try {
            $objSwitchStatus = new SwitchStatus($this->objEntityManager, $this->objLogger);
            $objSwitch = $objSwitchStatus->status($idSwitch);
            
            if(!($objSwitch instanceof EntitySwitchs)){
                throw new NotFoundHttpException("Not Found");
            }
            
            $defaultContext = [
                AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                    if($object instanceof Vlan){
                        return $object->getTagId();
                    }else{
                        return $object->getName();
                    }
                },
                AbstractNormalizer::CALLBACKS => [
                    'createdAt' => function ($dateTime) {
                    return $dateTime instanceof \DateTime ? $dateTime->format(\DateTime::ISO8601) : NULL;
                    },
                    'removedAt' => function ($dateTime) {
                    return $dateTime instanceof \DateTime ? $dateTime->format(\DateTime::ISO8601) : NULL;
                    },
                    ],
                    ];
            
            $objGetSetMethodNormalizer = new GetSetMethodNormalizer(NULL, NULL, NULL, NULL, NULL, $defaultContext);
            $objSerializer = new Serializer([$objGetSetMethodNormalizer]);
            return $objSerializer->normalize($objSwitch);
        } catch (\RuntimeException $e){
            throw $e;
        } catch (\Exception $e){
            throw $e;
        }
    }
    
    public function list(Request $objRequest)
    {
        try {
            $objListing = new Listing($this->objEntityManager);
            $arraySwitch = $objListing->list($objRequest);
            $this->objLogger->error("teste", ['jdjdjd'=>12313]);
            if(!count($arraySwitch)){
                throw new NotFoundHttpException("Not Found");
            }
            
            $defaultContext = [
                AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                    if($object instanceof Vlan){
                        return $object->getTagId();
                    }else{
                        return $object->getName();
                    }
                },
                AbstractNormalizer::CALLBACKS => [
                    'createdAt' => function ($dateTime) {
                        return $dateTime instanceof \DateTime ? $dateTime->format(\DateTime::ISO8601) : NULL;
                    },
                    'removedAt' => function ($dateTime) {
                        return $dateTime instanceof \DateTime ? $dateTime->format(\DateTime::ISO8601) : NULL;
                    },
                ],
            ];
            
            $objGetSetMethodNormalizer = new GetSetMethodNormalizer(NULL, NULL, NULL, NULL, NULL, $defaultContext);
            $objSerializer = new Serializer([$objGetSetMethodNormalizer]);
            return $objSerializer->normalize($arraySwitch);
        } catch (\RuntimeException $e){
            throw $e;
        } catch (\Exception $e){
            throw $e;
        }
    }
}

