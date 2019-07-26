<?php

namespace App\Entity\Redes;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class SwitchModel
{
    private $id;

    private $name;

    private $active;

    private $createdAt;

    private $removedAt;

    private $brand;

    private $switchModelPort;

    public function __construct()
    {
        $this->switchModelPort = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getRemovedAt(): ?\DateTimeInterface
    {
        return $this->removedAt;
    }

    public function setRemovedAt(?\DateTimeInterface $removedAt): self
    {
        $this->removedAt = $removedAt;

        return $this;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function setBrand($brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return Collection|SwitchModelPort[]
     */
    public function getSwitchModelPort(): Collection
    {
        return $this->switchModelPort;
    }

    public function addSwitchModelPort(SwitchModelPort $switchModelPort): self
    {
        if (!$this->switchModelPort->contains($switchModelPort)) {
            $this->switchModelPort[] = $switchModelPort;
            $switchModelPort->setSwitchModel($this);
        }

        return $this;
    }

    public function removeSwitchModelPort(SwitchModelPort $switchModelPort): self
    {
        if ($this->switchModelPort->contains($switchModelPort)) {
            $this->switchModelPort->removeElement($switchModelPort);
            // set the owning side to null (unless already changed)
            if ($switchModelPort->getSwitchModel() === $this) {
                $switchModelPort->setSwitchModel(null);
            }
        }

        return $this;
    }
}
