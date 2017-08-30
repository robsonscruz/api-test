<?php

namespace AppBundle\Entity;

/**
 * HistoryDeploy
 */
class HistoryDeploy
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $component;

    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $responsible;

    /**
     * @var string
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * HistoryDeploy constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

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
     * Set component
     *
     * @param string $component
     *
     * @return HistoryDeploy
     */
    public function setComponent($component)
    {
        $this->component = $component;

        return $this;
    }

    /**
     * Get component
     *
     * @return string
     */
    public function getComponent()
    {
        return $this->component;
    }

    /**
     * Set version
     *
     * @param string $version
     *
     * @return HistoryDeploy
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set responsible
     *
     * @param string $responsible
     *
     * @return HistoryDeploy
     */
    public function setResponsible($responsible)
    {
        $this->responsible = $responsible;

        return $this;
    }

    /**
     * Get responsible
     *
     * @return string
     */
    public function getResponsible()
    {
        return $this->responsible;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return HistoryDeploy
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return HistoryDeploy
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param array $data
     */
    public function importFromArray(array $data)
    {
        $parameters = (object) $data;
        $this->setComponent($parameters->component);
        $this->setVersion($parameters->version);
        $this->setResponsible($parameters->responsible);
        $this->setStatus($parameters->status);
    }
}

