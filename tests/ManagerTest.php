<?php

require_once __DIR__ . '/mocks/DummyTransformer.php';
require_once __DIR__ . '/mocks/DummySerializer.php';

class ManagerTest extends PHPUnit_Framework_TestCase {

  public function testCanSerializeItem()
  {
    $manager = new \Manuel\Manager(new DummySerializer);

    $data = array(
      'id'   => 1,
      'test' => 'one'
    );

    $payload = $manager->translate(new \Manuel\Resource\Item($data, new DummyTransformer));

    $expected = array(
      'id'   => 1,
      'test' => 'data_1',
      'simple_item' => 2,
      'simple_collection' => [3, 4],
      'test_item' => array('id' => 5, 'test' => 'data_5'),
      'test_collection' => array(
        array('id' => 6, 'test' => 'data_6'),
        array('id' => 7, 'test' => 'data_7')),
      'links' => array('simple_linked' => '/customer/1/testing')
    );

    $this->assertEquals($expected, $payload);
  }

  public function testCanSerializeCollection()
  {
    $manager = new \Manuel\Manager(new DummySerializer);

    $data = array(
      array('id' => 1, 'test' => 'one'),
      array('id' => 2, 'test' => 'two')
    );

    $payload = $manager->translate(new \Manuel\Resource\Collection($data, new DummyTransformer));

    $expected = array(
      array(
        'id' => 1,
        'test' => 'data_1',
        'simple_item' => 2,
        'simple_collection' => [3, 4],
        'test_item' => array('id' => 5, 'test' => 'data_5'),
        'test_collection' => array(
          array('id' => 6, 'test' => 'data_6'),
          array('id' => 7, 'test' => 'data_7')),
        'links'   => array('simple_linked' => '/customer/1/testing')
      ),
      array(
        'id' => 2,
        'test' => 'data_2',
        'simple_item' => 2,
        'simple_collection' => [3, 4],
        'test_item' => array('id' => 5, 'test' => 'data_5'),
        'test_collection' => array(
          array('id' => 6, 'test' => 'data_6'),
          array('id' => 7, 'test' => 'data_7')),
        'links'   => array('simple_linked' => '/customer/1/testing')
      ),
    );

    $this->assertEquals($expected, $payload);
  }

  public function testJsonAPICreate()
  {
    $manager = new \Manuel\Manager(new \Manuel\Serializer\JsonAPISerializer);

    $data = array('id' => 1, 'test' => 'one');

    $payload = $manager->translate(new \Manuel\Resource\Item($data, new DummyTransformer));

    $expected = array(
      'data' => array(
        'id' => 1,
        'type' => 'test',
        'attributes' => array(
          'test' => 'data_1'
        ),
        'relationships' => array(
          'simple_item' => array(
            'data' => array('id' => 2, 'type' => 'simple_item')
          ),
          'simple_collection' => array(
            'data' => array(
              array('id' => 3, 'type' => 'simple_collection'),
              array('id' => 4, 'type' => 'simple_collection'))
          ),
          'test_item' => array(
            'data' => array(
              'id' => 5, 'type' => 'test_embedded', 'attributes' => array('test' => 'data_5')
            )
          ),
          'test_collection' => array(
            'data' => array(
              array('id' => 6, 'type' => 'test_embedded', 'attributes' => array('test' => 'data_6')),
              array('id' => 7, 'type' => 'test_embedded', 'attributes' => array('test' => 'data_7')),
            )
          ),
          'simple_linked' => array(
            'links' => array(
              'related' => '/customer/1/testing'
            )
          )
        )
      )
    );

    $this->assertEquals($expected, $payload);
  }

}
