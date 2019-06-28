<?php

namespace App\Entity\Redes;

/**
 * SwitchModel
 */
class SwitchModel
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
     * @var redes.marca_switch
     */
    private $brand;


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
     * @return SwitchModel
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
     * @return SwitchModel
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
     * @return SwitchModel
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
     * @return SwitchModel
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
     * Set brand.
     *
     * @param redes.marca_switch $brand
     *
     * @return SwitchModel
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand.
     *
     * @return redes.marca_switch
     */
    public function getBrand()
    {
        return $this->brand;
    }
}
