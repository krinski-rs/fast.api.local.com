<?php
namespace App\Services\Service;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Repository\RepositoryFactory;
use Doctrine\DBAL\Query\QueryBuilder;

class Listing
{
    private $objEntityManager = NULL;
    
    public function __construct(EntityManager $objEntityManager)
    {
        $this->objEntityManager = $objEntityManager;
    }
    
    public function get(int $idService)
    {
        try {
            $objRepositoryService = $this->objEntityManager->getRepository('AppEntity:Redes\Service');
            $objService = $objRepositoryService->find($idService);
            return $objService;
        } catch (\RuntimeException $e){
            throw $e;
        } catch (\Exception $e){
            throw $e;
        }
    }
    
    public function list(Request $objRequest)
    {
        try {
            $objRepositoryService = $this->objEntityManager->getRepository('AppEntity:Redes\Service');
            $criteria = [];
            
            $objQueryBuilder = $objRepositoryService->createQueryBuilder('serv');
            $objExprEq = $objQueryBuilder->expr()->isNull('serv.removedAt');
            $objQueryBuilder->andWhere($objExprEq);
            
            if($objRequest->get('name', false)){
                $objExprLike = $objQueryBuilder->expr()->like('serv.name', ':name');
                $objQueryBuilder->andWhere($objExprLike);
                $criteria['name'] = "%{$objRequest->get('name', null)}%";
            }
            
            if($objRequest->get('active', false)){
                $objExprEq = $objQueryBuilder->expr()->eq('serv.active', ':active');
                $objQueryBuilder->andWhere($objExprEq);
                $criteria['active'] = $objRequest->get('active', null);
            }
            
            if($objRequest->get('createdAt', false)){
                $objExprEq = $objQueryBuilder->expr()->eq('serv.createdAt', ':createdAt');
                $objQueryBuilder->andWhere($objExprEq);
                $criteria['createdAt'] = $objRequest->get('createdAt', null);
            }
            if(count($criteria)){
                $objQueryBuilder->setParameters($criteria);
            }
            $arrayService = $objQueryBuilder->getQuery()->getResult();
            return $arrayService;
        } catch (\RuntimeException $e){
            throw $e;
        } catch (\Exception $e){
            throw $e;
        }
    }
}

