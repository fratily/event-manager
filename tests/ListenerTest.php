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

use Fratily\EventManager\EventInterface;
use Fratily\EventManager\Listener;

/**
 *
 */
class ListenerTest extends \PHPUnit\Framework\TestCase{

    public function testInitAndGet(){
        $callback   = [new \SplQueue(), "enqueue"];
        $priority   = 10;

        $listener   = new Listener($callback, $priority);

        $this->assertSame($callback, $listener->getCallback());
        $this->assertSame($priority, $listener->getPriority());
    }

    /**
     * @dataProvider    dataProviderIsSame
     */
    public function testIsSame($callback1, $callback2, $expected){
        $listener   = new Listener($callback1, 1);

        $this->assertSame($expected, $listener->isSame($callback2));
    }

    public function dataProviderIsSame(){
        $closure    = function(){return "a";};

        return [
            [
                function(int $a){
                    return $a * 10;
                },
                function(int $a){
                    return $a * 10;
                },
                false,
            ],
            ["json_encode","json_encode",true],
            [$closure, $closure, true]
        ];
    }

    public function testTrigger(){
        $event      = $this->createMock(EventInterface::class);
        $callback   = function($event, $a, $b, $c, $d){
            return $a + $b + $c + $d;
        };
        $priority   = 1;

        $listener   = new Listener($callback, $priority);

        $this->assertSame(15, $listener->trigger($event, [1, 2, 4, 8]));
    }
}