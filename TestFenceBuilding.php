<?php

/**
 * Created by PhpStorm.
 * User: luciavelasco
 * Date: 09/11/2015
 * Time: 11:19
 */
require_once 'fence-challenge.php';
//format = [posts, rails or poles, length or distance]

class TestFenceBuilding extends PHPUnit_Framework_TestCase
{
//    $fence = new Fence();

    /**
     * @param $posts
     * @param $rails
     * @param $overshoot
     * @param $length
     *
     * @dataProvider dataProviderPostsAndRails
     */
    public function testGiveLengthFindResources($posts, $rails, $overshoot, $length)
    {
        $fence = new Fence();
        $this->assertEquals(
            array($posts, $rails, $overshoot),
            $fence->giveLengthFindResources($length)
        );
    }

    public static function dataProviderPostsAndRails()
    {
        //[posts, rails, overshoot, length
        $tests = [
            [2, 1, 0, 1.7],
            [8, 7, 1.5, 9.8],
            [8, 7, 0.1, 11.2]
        ];
        return $tests;
    }

    /**
     * @param $leftoverPosts
     * @param $leftoverRails
     * @param $length
     * @param $postsGiven
     * @param $railsGiven
     *
     * @dataProvider dataProviderLength
     */
    public function testGiveResourcesFindLength($leftoverPosts, $leftoverRails, $length, $postsGiven, $railsGiven)
    {
        $fence = new Fence();
        $this->assertEquals(
            [$leftoverPosts, $leftoverRails, $length],
            $fence->giveResourcesFindLength($postsGiven, $railsGiven)
        );
    }

    public static function dataProviderLength()
    {
        //posts, rails, length, posts given, rails given
        $tests = [
            [0, 0, 3.3, 3, 2],
            [3, 0, 8.1, 9, 5],
            [0, 5, 6.5, 5, 9]
        ];
        return $tests;
    }
}
