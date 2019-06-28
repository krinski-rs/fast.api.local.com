<?php

namespace App\Entity\Redes;

/**
 * Switchs
 */
class Switchs
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $active = true;

    /**
     * @var \DateTime
     */
    private $createdAt = 'now()';

    /**
     * @var \DateTime|null
     */
    private $removedAt;

    /**
     * @var \App\Entity\Redes\Service
     */
    private $service;

    /**
     * @var \App\Entity\Redes\SwitchModel
     */
    private $switchModel;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Switchs
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set active.
     *
     * @param bool $active
     *
     * @return Switchs
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Switchs
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set removedAt.
     *
     * @param \DateTime|null $removedAt
     *
     * @return Switchs
     */
    public function setRemovedAt($removedAt = null)
    {
        $this->removedAt = $removedAt;

        return $this;
    }

    /**
     * Get removedAt.
     *
     * @return \DateTime|null
     */
    public function getRemovedAt()
    {
        return $this->removedAt;
    }

    /**
     * Set service.
     *
     * @param \App\Entity\Redes\Service|null $service
     *
     * @return Switchs
     */
    public function setService(\App\Entity\Redes\Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service.
     *
     * @return \App\Entity\Redes\Service|null
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set switchModel.
     *
     * @param \App\Entity\Redes\SwitchModel|null $switchModel
     *
     * @return Switchs
     */
    public function setSwitchModel(\App\Entity\Redes\SwitchModel $switchModel = null)
    {
        $this->switchModel = $switchModel;

        return $this;
    }

    /**
     * Get switchModel.
     *
     * @return \App\Entity\Redes\SwitchModel|null
     */
    public function getSwitchModel()
    {
        return $this->switchModel;
    }
}
