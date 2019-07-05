<?php
namespace App\Services\Pop;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class Listing
{
    private $objEntityManager = NULL;
    
    public function __construct(EntityManager $objEntityManager)
    {
        $this->objEntityManager = $objEntityManager;
    }
    
    public function get(int $idPop)
    {
        try {
            $objRepositoryPop = $this->objEntityManager->getRepository('AppEntity:Redes\Pop');
            $objPop = $objRepositoryPop->find($idPop);
            return $objPop;
        } catch (\RuntimeException $e){
            throw $e;
        } catch (\Exception $e){
            throw $e;
        }
    }
    
    public function list(Request $objRequest)
    {
        try {
            $objRepositoryPop = $this->objEntityManager->getRepository('AppEntity:Redes\Pop');
            $criteria = [];
            
            $objQueryBuilder = $objRepositoryPop->createQueryBuilder('serv');
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
            $arrayPop = $objQueryBuilder->getQuery()->getResult();
            return $arrayPop;
        } catch (\RuntimeException $e){
            throw $e;
        } catch (\Exception $e){
            throw $e;
        }
    }
}

