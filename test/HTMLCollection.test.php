<?php
namespace phpgt\dom;

class HTMLCollectionTest extends \PHPUnit_Framework_TestCase {

public function testType() {
	$document = new HTMLDocument(test\Helper::HTML);
	$this->assertInstanceOf("\phpgt\dom\HTMLCollection", $document->children);
}

public function testNonElementsRemoved() {
	$document = new HTMLDocument(test\Helper::HTML_MORE);
	$bodyChildNodes = $document->body->childNodes;
	$bodyChildren = $document->body->children;

	$this->assertInstanceOf("\DOMNodeList", $bodyChildNodes);
	$this->assertInstanceOf("\phpgt\dom\HTMLCollection", $bodyChildren);

	$this->assertInstanceOf("\phpgt\dom\Text", $bodyChildNodes->item(0));
	$this->assertInstanceOf("\phpgt\dom\Element", $bodyChildren->item(0));
}

public function testArrayAccessImplementation() {
    $document = new HTMLDocument(test\Helper::HTML_MORE);
    $collection = $document->body->children;

    // test if the collection implements ArrayAccess
    $this->assertInstanceOf('\ArrayAccess', $collection);

    // test if offset 0 exists
    $this->assertArrayHasKey(0, $collection);

    // test if the first item is an Element instance
    $first = $collection[0];
    $this->assertInstanceOf('\phpgt\dom\Element', $first);

    // test if the collection is read only
    $this->setExpectedException(\BadMethodCallException::class);
    $collection[$collection->length] = new Element('br');
    unset($collection[0]);

}

public function testCountMethod() {
    $document = new HTMLDocument(test\Helper::HTML_MORE);
    $childrenCount = count($document->body->children);
    // must have 11 childrens
    $this->assertEquals(11, $childrenCount);
}

}#