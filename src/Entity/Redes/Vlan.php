<?php

namespace App\Entity\Redes;

/**
 * Vlan
 */
class Vlan
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string|null
     */
    private $descricao;

    /**
     * @var int|null
     */
    private $servicoId;

    /**
     * @var int
     */
    private $status;

    /**
     * @var \App\Entity\Redes\Switch
     */
    private $switch;


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
     * Set descricao.
     *
     * @param string|null $descricao
     *
     * @return Vlan
     */
    public function setDescricao($descricao = null)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao.
     *
     * @return string|null
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set servicoId.
     *
     * @param int|null $servicoId
     *
     * @return Vlan
     */
    public function setServicoId($servicoId = null)
    {
        $this->servicoId = $servicoId;

        return $this;
    }

    /**
     * Get servicoId.
     *
     * @return int|null
     */
    public function getServicoId()
    {
        return $this->servicoId;
    }

    /**
     * Set status.
     *
     * @param int $status
     *
     * @return Vlan
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set switch.
     *
     * @param \App\Entity\Redes\Switch|null $switch
     *
     * @return Vlan
     */
    public function setSwitch(\App\Entity\Redes\Switch $switch = null)
    {
        $this->switch = $switch;

        return $this;
    }

    /**
     * Get switch.
     *
     * @return \App\Entity\Redes\Switch|null
     */
    public function getSwitch()
    {
        return $this->switch;
    }
}
