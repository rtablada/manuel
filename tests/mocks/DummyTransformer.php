<?php

use Manuel\Transformer\TransformerAbstract;
use Manuel\Resource\Item;
use Manuel\Resource\Collection;

class DummyTransformer extends TransformerAbstract {

  /**
   * @inheritdoc
   */
  protected $type = 'test';

  /**
   * @inheritdoc
   */
  protected $relationships = [ 'simple_item', 'simple_collection', 'relation_returns_null' ];

  /**
   * @inheritdoc
   */
  protected $linkedResources = [ 'simple_linked' ];

  /**
   * @inheritdoc
   */
  protected $embeddedResources = [ 'test_item', 'test_collection' ];

  /**
   * @inheritdoc
   */
  protected $includedResources = [ 'sideload_item', 'sideload_collection' ];

  /**
   *
   *
   * @param array $data
   * @return array
   */
  public function transform($data)
  {
    return array(
      'id'   => (int) $data['id'],
      'test' => 'data_' . $data['id']
    );
  }

  /**
   *
   * @param array $data
   * @return integer
   */
  public function relationshipSimpleItem($data)
  {
    return 2;
  }

  /**
   *
   * @param array $data
   * @return array
   */
  public function relationshipSimpleCollection($data)
  {
    return [3, 4];
  }

  /**
   *
   * @param array $data
   * @return string
   */
  public function linkedSimpleLinked($data)
  {
    return '/customer/1/testing';
  }

  /**
   *
   * @param array $data
   * @return Item
   */
  public function embeddedTestItem($data)
  {
    return new Item(array('id' => 5), new DummyEmbeddedTransformer);
  }

  /**
   *
   * @param array $data
   * @return Collection
   */
  public function embeddedTestCollection($data)
  {
    $items = array(array('id' => 6), array('id' => 7));

    return new Collection($items, new DummyEmbeddedTransformer);
  }

  /**
   *
   * @param array $data
   * @return Item
   */
  public function includeSideloadItem($data)
  {
    return new Item(array('id' => 8), new DummyEmbeddedTransformer);
  }

  /**
   *
   * @param array $data
   * @return Collection
   */
  public function includeSideloadCollection($data)
  {
    $items = array(array('id' => 9), array('id' => 10));

    return new Collection($items, new DummyEmbeddedTransformer);
  }

    public function relationshipRelationReturnsNull($data)
    {
        return null;
    }

}
