<?php
namespace App\Services;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpFoundation\Request;
use Monolog\Logger;
use App\Services\Service\Listing;
use App\Entity\Redes\Service as EntityService;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Services\Service\Create;

class Service
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
            $objService = $objCreate
                ->create($objRequest)
                ->save();
            $defaultContext = [
                AbstractNormalizer::CALLBACKS => [
                    'createdAt' => function ($dateTime) {
                        return $dateTime instanceof \DateTime ? $dateTime->format(\DateTime::ISO8601) : '';
                    },
                    'removedAt' => function ($dateTime) {
                        return $dateTime instanceof \DateTime ? $dateTime->format(\DateTime::ISO8601) : '';
                    }
                ],
            ];
            
            $objGetSetMethodNormalizer = new GetSetMethodNormalizer(null, null, null, null, null, $defaultContext);
            $objSerializer = new Serializer([$objGetSetMethodNormalizer]);
            return $objSerializer->normalize($objService);
        } catch (\RuntimeException $e){
            throw $e;
        } catch (\Exception $e){
            throw $e;
        }
    }
    
    public function get(int $idService)
    {
        try {
            $objListing = new Listing($this->objEntityManager);
            $objService = $objListing->get($idService);
            
            if(!($objService instanceof EntityService)){
                throw new NotFoundHttpException("Not Found");
            }
            
            $defaultContext = [
                AbstractNormalizer::CALLBACKS => [
                    'createdAt' => function ($dateTime) {
                        return $dateTime instanceof \DateTime ? $dateTime->format(\DateTime::ISO8601) : NULL;
                    },
                    'removedAt' => function ($dateTime) {
                        return $dateTime instanceof \DateTime ? $dateTime->format(\DateTime::ISO8601) : NULL;
                    },
                ],
            ];
            
            $objGetSetMethodNormalizer = new GetSetMethodNormalizer(null, null, null, null, null, $defaultContext);
            $objSerializer = new Serializer([$objGetSetMethodNormalizer]);
            return $objSerializer->normalize($objService);
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
            $arrayService = $objListing->list($objRequest);
            $this->objLogger->error("teste", ['jdjdjd'=>12313]);
            if(!count($arrayService)){
                throw new NotFoundHttpException("Not Found");
            }
            
            $defaultContext = [
                AbstractNormalizer::CALLBACKS => [
                    'createdAt' => function ($dateTime) {
                        return $dateTime instanceof \DateTime ? $dateTime->format(\DateTime::ISO8601) : NULL;
                    },
                    'removedAt' => function ($dateTime) {
                        return $dateTime instanceof \DateTime ? $dateTime->format(\DateTime::ISO8601) : NULL;
                    },
                ],
            ];
            
            $objGetSetMethodNormalizer = new GetSetMethodNormalizer(null, null, null, null, null, $defaultContext);
            $objSerializer = new Serializer([$objGetSetMethodNormalizer]);
            return $objSerializer->normalize($arrayService);
        } catch (\RuntimeException $e){
            throw $e;
        } catch (\Exception $e){
            throw $e;
        }
    }
}

