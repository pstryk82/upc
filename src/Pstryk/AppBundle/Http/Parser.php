<?php

namespace Pstryk\AppBundle\Http;

use Pstryk\AppBundle\Entity\Downstream;
use Doctrine\Common\Collections\ArrayCollection;

class Parser {

    /**
     * @param string $inputString
     * 
     * @return ArrayCollection
     */
    public function parse($inputString) {
        $begin = strpos($inputString, '<tbody>');
        $tableBodyString = substr(
            $inputString,
            $begin,
            strpos($inputString, '</tbody>') - $begin
        );
        
        $downstreams = new ArrayCollection();
        $rows = preg_split('#</tr>\s+?<tr>#', $tableBodyString);
        $now = new \DateTime();
        
        foreach ($rows as $row) {
            $downstreamArray = preg_split('#</td>\s+?<td>#', $row);
            $downstream = new Downstream();
            $downstream->setReceiverNo($this->matchNumber($downstreamArray[0], 'Receiver No.'));
            $downstream->setChannelId($this->matchNumber($downstreamArray[1], 'Channel Id'));
            $downstream->setLockStatus($this->matchString($downstreamArray[2], 'Lock status'));
            $downstream->setFrequency($this->matchNumber($downstreamArray[3], 'Frequency'));
            $downstream->setModulation($this->matchString($downstreamArray[4], 'Modulation'));
            $downstream->setSymbolRate($this->matchString($downstreamArray[5], 'SymbolRate'));
            $downstream->setSnr($this->matchFloat($downstreamArray[6], 'Snr'));
            $downstream->setPower($this->matchFloat($downstreamArray[7], 'Power'));
            $downstream->setDateTime($now);
            $downstreams->add($downstream);
        }
        
        return $downstreams;
    }
    
    private function matchNumber($htmlFragment, $fieldName) {
        return (int)$this->match('#(\d+)#', $htmlFragment, $fieldName);
    }
    
    private function matchFloat($htmlFragment, $fieldName) {
        return $this->match('#(\d+(\.?\d+))#', $htmlFragment, $fieldName);
    }
    
    private function matchString($htmlFragment, $fieldName) {
        return $this->match('#<script>i18n\(\"(.*)\"\)</script>#', $htmlFragment, $fieldName);
    }
    
    /**
     * 
     * @param string $regex
     * @param string $htmlFragment
     * @param string $fieldName
     * 
     * @return string
     * 
     * @throws Exception\FieldNotMatchedException
     */
    private function match($regex, $htmlFragment, $fieldName) {
        try {
            preg_match($regex, $htmlFragment, $matches);

            return $matches[1];
        } catch (\Exception $ex) {
            throw new Exception\FieldNotMatchedException(
                'Could not match ' . $fieldName . ': ' . $htmlFragment
            );
        }
    }
}
