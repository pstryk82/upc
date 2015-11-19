<?php

namespace Pstryk\AppBundle\Http;

use Pstryk\AppBundle\Entity\Downstream;

class Parser {
    public function parse($inputString) {
        $begin = strpos($inputString, '<tbody>');
        $tableBodyString = substr(
            $inputString,
            $begin,
            strpos($inputString, '</tbody>') - $begin
        );
        var_dump($tableBodyString);
        $downstream = new Downstream();
        
    }
}
