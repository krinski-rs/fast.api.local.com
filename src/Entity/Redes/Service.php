<?php

namespace App\Entity\Redes;

/**
 * Service
 */
class Service
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
     * @return Service
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
     * @return Service
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
     * @return Service
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
     * @return Service
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
}
