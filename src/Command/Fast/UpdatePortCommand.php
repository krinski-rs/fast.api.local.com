<?php
namespace App\Command\Fast;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Services\Switchs;
use Symfony\Component\HttpFoundation\Request;

class UpdatePortCommand extends Command
{
    use LockableTrait;
    
    protected static $defaultName = 'fast:port:update';
    
    protected function configure()
    {
        $this->setName('fast:port:update')
            ->setDescription('Command for updating switch ports.')
            ->addOption('switch', 's', InputOption::VALUE_OPTIONAL, 'Id of switch ex.: --switch=123456')
            ->addOption('port', 'p', InputOption::VALUE_OPTIONAL, 'Id of port ex.: --port=1010')
            ->addOption('offset', 'o', InputOption::VALUE_OPTIONAL, 'Pagination shift ex.: --offset=10', 0)
            ->addOption('limit', 'l', InputOption::VALUE_OPTIONAL, 'Record limit ex.: --limit=10', 50)
            ->setHelp("This command allows you to update a specific port\nor all ports on a switch or ports on active switchs.")
        ;
    }
    
    protected function execute(InputInterface $objInputInterface, OutputInterface $objOutputInterface)
    {
        $objSymfonyStyle = new SymfonyStyle($objInputInterface, $objOutputInterface);
        $objSymfonyStyle->title("Update Ports");
        $objSymfonyStyle->section("Start  ".date("Y-m-d H:i:s"));
        
        if (!$this->lock()) {
            $objSymfonyStyle->caution("This command is already running");
        }
        try {
            $objSwitchsService = $this->getApplication()->getKernel()->getContainer()->get('services.switchs');
            if(!($objSwitchsService instanceof Switchs)){
                throw new \Exception("Service 'services.switchs' not found.");
            }
            $objRequest = new Request();
            
            if($objInputInterface->getOption('switch') !== NULL){
                $objRequest->attributes->set('id', $objInputInterface->getOption('switch'));
            }else{
                $objRequest->attributes->set('offset', $objInputInterface->getOption('offset'));
                $objRequest->attributes->set('limit', $objInputInterface->getOption('limit'));
            }
            
            $arraySwitchs = $objSwitchsService->list($objRequest, TRUE);
            
            if($arraySwitchs['total']){
                reset($arraySwitchs['data']);
                while($objSwitchs = current($arraySwitchs['data'])){
                    $objSwitchsService->updatePorts($objSwitchs);
                    next($arraySwitchs['data']);
                }
            }
            
            
//             if(!($objIntegracaoProtheus instanceof IntegracaoProtheus)){
//                 $objSymfonyStyle->caution("Serviço de integração não localizado.");
//                 return 0;
//             }

//             $contCodigoid = $objInputInterface->getOption('circ');
//             if($contCodigoid){
//                 if(!is_numeric($contCodigoid) || ((integer)$contCodigoid <= 0)){
//                     $objSymfonyStyle->caution("O parâmetro [--circ|-c] deve ser um número inteiro maior que zero.");
//                     return 0;
//                 }
//                 $objSymfonyStyle->note("Integrar circuito '{$contCodigoid}'");
// //                 $objIntegracaoProtheus->circuito($contCodigoid);
//                 $objSymfonyStyle->success("Circuito '{$contCodigoid}' integrado");
//             }else{
//                 $objSymfonyStyle->note("Integrar circuitos");
//                 $objIntegracaoProtheus->circuitos($objInputInterface->getOption('limit'));
//                 $objSymfonyStyle->success("Circuitos integrados");
//             }
            
            $this->release();
            
        } catch (\Exception $e) {
            $objSymfonyStyle->error("ERRO: {$e->getCode()}");
            $objSymfonyStyle->error("File:{$e->getFile()}");
            $objSymfonyStyle->error("Line:{$e->getLine()}");
            $objSymfonyStyle->error("Message:{$e->getMessage()}");
            $this->release();
        }
        $objSymfonyStyle->section("Finish ".date("Y-m-d H:i:s"));
    }
}
