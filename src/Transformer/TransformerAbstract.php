<?php namespace Manuel\Transformer;

abstract class TransformerAbstract {

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $relationships = array();

    /**
     * @var array
     */
    protected $linkedResources = array();

    /**
     * @var array
     */
    protected $embeddedResources = array();

    /**
     * @var array
     */
    protected $includedResources = array();

    /**
     * Return the primary key for the data array.
     *
     * @return string
     */
    public function getPrimaryKeyName()
    {
        return $this->primaryKey;
    }

    /**
     * Return the name of the resource type.
     *
     * @return string
     */
    public function getTypeKey()
    {
        return $this->type;
    }

    /**
     * Return an array of simple relationship names for thie resource.
     *
     * @return array
     */
    public function getRelationships()
    {
        return $this->relationships;
    }

    /**
     * Return an array of linked resource names for this resource.
     *
     * @return array
     */
    public function getLinkedResources()
    {
        return $this->linkedResources;
    }

    /**
     * Return an array of embedded resource names for this resource.
     *
     * @return array
     */
    public function getEmbeddedResources()
    {
        return $this->embeddedResources;
    }

    /**
     * Return an array of resources that should be sideloaded.
     *
     * @return array
     */
    public function getIncludedResources()
    {
        return $this->includedResources;
    }

}
