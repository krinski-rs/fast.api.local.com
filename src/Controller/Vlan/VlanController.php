<?php
namespace App\Controller\Vlan;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Services\Vlan;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Monolog\Logger;

class VlanController extends AbstractController
{    
    private $objVlan = NULL;
    private $objLogger  = NULL;
    
    public function __construct(Vlan $objVlan, Logger $objLogger){
        $this->objVlan = $objVlan;
        $this->objLogger = $objLogger;
    }
    
    public function getStatus(Request $objRequest)
    {
        try {
            if(!$this->objVlan instanceof Vlan){
                return new JsonResponse(['message'=> 'Class "App\Services\Vlan not found."'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            $retorno = $this->objVlan->getStatus($objRequest);
            return new JsonResponse($retorno, Response::HTTP_OK);
        } catch (\RuntimeException $e) {
            return new JsonResponse(['mensagem'=>$e->getMessage()], Response::HTTP_PRECONDITION_FAILED);
        } catch (\Exception $e) {
            return new JsonResponse(['mensagem'=>$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function postVlan(Request $objRequest)
    {
        try {
            if(!$this->objVlan instanceof Vlan){
                return new JsonResponse(['message'=> 'Class "App\Services\Vlan not found."'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            $retorno = $this->objVlan->create($objRequest);
            return new JsonResponse($retorno, Response::HTTP_OK);
        } catch (\RuntimeException $e) {
            return new JsonResponse(['mensagem'=>$e->getMessage()], Response::HTTP_PRECONDITION_FAILED);
        } catch (\Exception $e) {
            return new JsonResponse(['mensagem'=>$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function getVlan(Request $objRequest, int $idVlan)
    {
        try {
            if(!$this->objVlan instanceof Vlan){
                return new JsonResponse(['message'=> 'Class "App\Services\Vlan not found."'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            $objVlan = $this->objVlan->get($idVlan);
            return new JsonResponse($objVlan, Response::HTTP_OK);
        } catch (NotFoundHttpException $e) {
            return new JsonResponse(NULL, Response::HTTP_NOT_FOUND);
        } catch (\RuntimeException $e) {
            return new JsonResponse(['mensagem'=>$e->getMessage()], Response::HTTP_PRECONDITION_FAILED);
        } catch (\Exception $e) {
            return new JsonResponse(['mensagem'=>$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function getVlans(Request $objRequest)
    {        
        try {
            if(!$this->objVlan instanceof Vlan){
                return new JsonResponse(['message'=> 'Class "App\Services\Vlan not found."'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            $arrayVlan = $this->objVlan->list($objRequest);
            return new JsonResponse($arrayVlan, Response::HTTP_OK);
        } catch (NotFoundHttpException $e) {
            return new JsonResponse(NULL, Response::HTTP_NOT_FOUND);
        } catch (\RuntimeException $e) {
            return new JsonResponse(['mensagem'=>$e->getMessage()], Response::HTTP_PRECONDITION_FAILED);
        } catch (\Exception $e) {
            return new JsonResponse(['mensagem'=>$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function deleteVlan(int $idVlan)
    {
        return new JsonResponse(['id'=>['deleteVlan']], Response::HTTP_OK);
    }
    
    public function putVlan(int $idVlan)
    {
        return new JsonResponse(['id'=>['putVlan']], Response::HTTP_OK);
    }
    
    public function patchVlan(int $idVlan)
    {
        return new JsonResponse(['id'=>['patchVlan']], Response::HTTP_OK);
    }
}

