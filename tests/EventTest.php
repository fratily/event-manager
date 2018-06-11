<?php
/**
 * FratilyPHP Event Manager
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @author      Kento Oka <kento-oka@kentoka.com>
 * @copyright   (c) Kento Oka
 * @license     MIT
 * @since       1.0.0
 */
namespace Fratily\Tests\EventManager;

use Fratily\EventManager\Event;

/**
 *
 */
class EventTest extends \PHPUnit\Framework\TestCase{


    public function testInitAndGet(){

        $name           = "event.name";
        $params         = ["foo" => "Foo", "bar" => "Bar"];
        $propagation    = false;

        $event  = new Event($name, $params, $propagation);

        $this->assertSame($name, $event->getName());
        $this->assertSame($params, $event->getParams());
        $this->assertSame("Foo", $event->getParam("foo", null));
        $this->assertSame("Baz", $event->getParam("baz", "Baz"));
        $this->assertSame($propagation, $event->isPropagation());
    }
}