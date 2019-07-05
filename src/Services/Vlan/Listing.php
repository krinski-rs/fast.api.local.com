<?php
namespace App\Services\Vlan;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class Listing
{
    private $objEntityManager = NULL;
    
    public function __construct(EntityManager $objEntityManager)
    {
        $this->objEntityManager = $objEntityManager;
    }
    
    public function get(int $idVlan)
    {
        try {
            $objRepositoryVlan = $this->objEntityManager->getRepository('AppEntity:Redes\Vlan');
            $objVlan = $objRepositoryVlan->find($idVlan);
            return $objVlan;
        } catch (\RuntimeException $e){
            throw $e;
        } catch (\Exception $e){
            throw $e;
        }
    }
    
    public function list(Request $objRequest)
    {
        try {
            $objRepositoryVlan = $this->objEntityManager->getRepository('AppEntity:Redes\Vlan');
            $criteria = [];
            
            $objQueryBuilder = $objRepositoryVlan->createQueryBuilder('vlan');
            $objExprEq = $objQueryBuilder->expr()->isNull('vlan.removedAt');
            $objQueryBuilder->andWhere($objExprEq);
            
            if($objRequest->get('description', NULL)){
                $objExprLike = $objQueryBuilder->expr()->like('vlan.description', ':description');
                $objQueryBuilder->andWhere($objExprLike);
                $criteria['description'] = "%{$objRequest->get('description', NULL)}%";
            }
            
            if($objRequest->get('active', NULL)){
                $objExprEq = $objQueryBuilder->expr()->eq('vlan.active', ':active');
                $objQueryBuilder->andWhere($objExprEq);
                $criteria['active'] = $objRequest->get('active', null);
            }
            
            if($objRequest->get('createdAt', NULL)){
                $objExprEq = $objQueryBuilder->expr()->eq('vlan.createdAt', ':createdAt');
                $objQueryBuilder->andWhere($objExprEq);
                $criteria['createdAt'] = $objRequest->get('createdAt', NULL);
            }
            if(count($criteria)){
                $objQueryBuilder->setParameters($criteria);
            }
            
            $limit = (integer)$objRequest->get('limit',15);
            $offset = ((integer)$objRequest->get('offset',0) * $limit);
            
            $objQueryBuilder->setFirstResult($offset);
            $objQueryBuilder->setMaxResults($limit);
            $objQueryBuilder->addOrderBy('vlan.id', 'ASC');
            
            $arrayVlan['data'] = $objQueryBuilder->getQuery()->getResult();
            $objQueryBuilder->resetDQLPart('orderBy');
            $objQueryBuilder->select('count(DISTINCT vlan.id) AS total');
            $objQueryBuilder->setFirstResult(0);
            $objQueryBuilder->setMaxResults(1);
            $resultSet = $objQueryBuilder->getQuery()->getResult();
            $arrayVlan['total'] = $resultSet[0]['total'];
            $arrayVlan['offset'] = (integer)$objRequest->get('offset',0);
            $arrayVlan['limit'] = (integer)$objRequest->get('limit',15);
            return $arrayVlan;
        } catch (\RuntimeException $e){
            throw $e;
        } catch (\Exception $e){
            throw $e;
        }
    }
}

