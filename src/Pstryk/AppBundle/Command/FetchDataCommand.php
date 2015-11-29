<?php

namespace Pstryk\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchDataCommand extends ContainerAwareCommand {
    
    public function configure() {
        $this->setName('upc:fetch');
    }
            

    public function execute(InputInterface $input, OutputInterface $output) {
        $manager = $this->getContainer()->get('app.manager.manager');
        
        
        $dataFromModem = $manager->getDataFromModem();
        $manager->save($dataFromModem);
    }
}
