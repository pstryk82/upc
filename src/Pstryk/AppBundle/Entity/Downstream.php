<?php

namespace Pstryk\AppBundle\Entity;

class Downstream
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $receiverNo;

    /**
     * @var integer
     */
    private $channelId;

    /**
     * @var string
     */
    private $lockStatus;

    /**
     * @var integer
     */
    private $frequency;

    /**
     * @var string
     */
    private $modulation;

    /**
     * @var integer
     */
    private $symbolRate;

    /**
     * @var float
     */
    private $snr;

    /**
     * @var float
     */
    private $power;

    /**
     * @var \DateTime
     */
    private $dateTime;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set receiverNo
     *
     * @param integer $receiverNo
     *
     * @return Downstream
     */
    public function setReceiverNo($receiverNo)
    {
        $this->receiverNo = $receiverNo;

        return $this;
    }

    /**
     * Get receiverNo
     *
     * @return integer
     */
    public function getReceiverNo()
    {
        return $this->receiverNo;
    }

    /**
     * Set channelId
     *
     * @param integer $channelId
     *
     * @return Downstream
     */
    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;

        return $this;
    }

    /**
     * Get channelId
     *
     * @return integer
     */
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * Set lockStatus
     *
     * @param string $lockStatus
     *
     * @return Downstream
     */
    public function setLockStatus($lockStatus)
    {
        $this->lockStatus = $lockStatus;

        return $this;
    }

    /**
     * Get lockStatus
     *
     * @return string
     */
    public function getLockStatus()
    {
        return $this->lockStatus;
    }

    /**
     * Set frequency
     *
     * @param integer $frequency
     *
     * @return Downstream
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * Get frequency
     *
     * @return integer
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Set modulation
     *
     * @param string $modulation
     *
     * @return Downstream
     */
    public function setModulation($modulation)
    {
        $this->modulation = $modulation;

        return $this;
    }

    /**
     * Get modulation
     *
     * @return string
     */
    public function getModulation()
    {
        return $this->modulation;
    }

    /**
     * Set symbolRate
     *
     * @param integer $symbolRate
     *
     * @return Downstream
     */
    public function setSymbolRate($symbolRate)
    {
        $this->symbolRate = $symbolRate;

        return $this;
    }

    /**
     * Get symbolRate
     *
     * @return integer
     */
    public function getSymbolRate()
    {
        return $this->symbolRate;
    }

    /**
     * Set snr
     *
     * @param float $snr
     *
     * @return Downstream
     */
    public function setSnr($snr)
    {
        $this->snr = $snr;

        return $this;
    }

    /**
     * Get snr
     *
     * @return float
     */
    public function getSnr()
    {
        return $this->snr;
    }

    /**
     * Set power
     *
     * @param float $power
     *
     * @return Downstream
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Get power
     *
     * @return float
     */
    public function getPower()
    {
        return $this->power;
    }
    
    public function getDateTime() {
        return $this->dateTime;
    }

    public function setDateTime(\DateTime $dateTime) {
        $this->dateTime = $dateTime;
        
        return $this;
    }


}

