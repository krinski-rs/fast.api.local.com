<?php
namespace App\Services\Vlan;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;
use Doctrine\ORM\EntityManager;
use Monolog\Logger;
use App\Entity\Redes\Vlan;
use App\DBAL\Type\Enum\Redes\StatusVlanType;

class Create
{
    private $objEntityManager   = NULL;
    private $objVlan            = NULL;
    private $objService         = NULL;
    private $objLogger          = NULL;
    
    public function __construct(EntityManager $objEntityManager, Logger $objLogger)
    {
        $this->objEntityManager = $objEntityManager;
        $this->objLogger = $objLogger;
    }
    
    public function create(Request $objRequest)
    {
        try {
            $choice = StatusVlanType::getChoices();
            $this->validate($objRequest);
            $this->objVlan = new Vlan();
            $this->objVlan->setActive(TRUE);
            $this->objVlan->setCreatedAt(new \DateTime());
            $this->objVlan->setDescription(trim($objRequest->get('description', NULL)));
            $this->objVlan->setRemovedAt(NULL);
            $this->objVlan->setService($this->objService);
            $this->objVlan->setStatus($choice[$objRequest->get('status', NULL)]);
            $this->objVlan->setTagId($objRequest->get('tag_id', NULL));
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
        
        $objChoice = new Assert\Choice(
            [
                'min' => 1,
                'max' => 1,
                'choices' => array_keys(StatusVlanType::getChoices()),
                'message' => 'O valor selecionado não é uma opção válida.',
                'minMessage' => 'Você deve selecionar pelo menos {{l imit }} opção.',
                'maxMessage' => 'Você deve selecionar no máximo {{ limit }} opção.'
            ]
        );
        
        $objTypeNumeric = new Assert\Type(
            [
                'message' => 'Este valor deve ser do tipo {{ type }}',
                'type' => 'numeric'
            ]
        );
        
        $objRecursiveValidator = Validation::createValidatorBuilder()->getValidator();
        
        $objCollection = new Assert\Collection(
            [
                'fields' => [
                    'description' => new Assert\Required( [
                            $objNotNull,
                            $objNotBlank,
                            $objLength
                        ]
                    ),
                    'status' => new Assert\Required( [
                            $objNotNull,
                            $objNotBlank,
                            $objChoice
                        ]
                    ),
                    'tag_id' => new Assert\Required( [
                            $objNotNull,
                            $objNotBlank,
                            $objTypeNumeric
                        ]
                    ),
                    'service' => new Assert\Required( [
                            $objNotNull,
                            $objNotBlank,
                            $objTypeNumeric
                        ]
                    )
                ]
            ]
        );
        $data = [
            'description'  => trim($objRequest->get('description', NULL)),
            'status' => $objRequest->get('status', NULL),
            'tag_id' => $objRequest->get('tag_id', NULL),
            'service' => $objRequest->get('service', NULL)
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
        $this->objService = $this->objEntityManager->getRepository('AppEntity:Redes\Service')->find(trim($objRequest->get('service', NULL)));
    }
    
    public function save()
    {
        $this->objEntityManager->persist($this->objVlan);
        $this->objEntityManager->flush();
        return $this->objVlan;
    }
}

