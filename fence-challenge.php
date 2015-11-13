<?php

//input number of posts and poles, get back length of fence and leftover posts or rails
//r = 1.5
//p = 0.1
//p = r + 1
//r = p - 1

//d = length (input)
//newd = ((d - 0.1) % 1.6) > 0 ? (d + (1 - ((d - 0.1) % 1.6))) : d;
//p = (newd - 0.1) / 1.6) + 1
//r = (newd - 0.1) / 1.6
//o = newd - d


//if (p < 2 || r < 1) 'A fence needs to comprise of at least two posts and one pole.'
//elsif ((p - 1) => r), 0.1 + 1.6r -> leftover p = p - (r + 1)
//else d = 0.1 + 1.6(p-1) -> leftover r = r - p


class Fence
{
    //getters and setters are for private properties
    public $numberOfPosts;
    public $numberOfRails;
    public $length;

    public function giveLengthFindResources($length)
    {
        //refactor var names plus fix rounding post bug (ceil)
        //MAKE IT READABLE TO THE NEXT PERSON WHO COMES ALONG
        //$divisibleLength = ((($length - 0.1) % 1.6) != 0 ? ($length + (1.6 - (($length - 0.1) % 1.6))) : $length); //func
        if ($length <= 0) {
            throw new InvalidArgumentException('Did you just try to neg my shit? Ain\'t no one getting away with that today. Nuh-uh.');
        }
        $numberOfRails = ceil(($length - 0.1) / 1.6);
        $numberOfPosts = ceil((($length - 0.1) / 1.6) + 1);
        $fenceLength = ($numberOfRails * 1.5) + ($numberOfPosts * 0.1);
        $overshoot = $fenceLength - $length;
        return [$numberOfPosts, $numberOfRails, $overshoot];
    }


    public function giveResourcesFindLength($posts, $rails)
    {
        //refactor var names
        //store result in variable -> shouldn't be more than two returns in a func
        if ($posts < 2 || $rails < 1) {
            throw new InvalidArgumentException('Woah slow down there bitch, you need at least two posts and a rail to build a fiddlesticking fence.');
        } elseif (($posts - 1) >= $rails) {
            $length = 0.1 + (1.6 * $rails);
            $leftoverPosts = $posts - ($rails + 1);
            $result = [$leftoverPosts, 0, $length];
        } else {
            $length = 0.1 + (1.6 * ($posts - 1));
            $leftoverRails = $rails - ($posts - 1);
            $result = [0, $leftoverRails, $length];
        }
        return $result;
    }

}

session_start();

$resultGiveResources = [];
$resultGiveLength = [];
$returnLength = null;
$returnResources = null;
$fence = new Fence;

function isInputValid($input)
{
    return (isset($input) &&
        !empty($input) &&
        is_numeric($input));
}

if (isInputValid($_GET["posts"]) && isInputValid($_GET["rails"])) {
    try {
        $resultGiveResources = $fence->giveResourcesFindLength($_GET['posts'], $_GET['rails']);
        $returnLength = 'The length of a fence built with ' . $_GET["posts"] . ' posts and ' . $_GET["rails"] . ' rails is ' . $resultGiveResources[2] . 'm, with ' . $resultGiveResources[1] . ' rails left over and ' . $resultGiveResources[0] . ' posts left over.';
    } catch(InvalidArgumentException $e) {
        $errorNeedMoreResources = $e->getMessage();
    }
}
if (isInputValid($_GET["length"])
) {
    try {

        $resultGiveLength = $fence->giveLengthFindResources($_GET['length']);
        $returnResources = 'You would need ' . $resultGiveLength[0] . ' posts and ' . $resultGiveLength[1] . ' rails to build a fence ' . round($_GET['length'],
                2) . 'm long. There would be an overshoot of ' . round($resultGiveLength[2], 2) . 'm.';
    } catch(InvalidArgumentException $e) {
        $errorInvalidLength = $e->getMessage();
    }
}
//make an error array, in frontend loop through each error and thingy so I don't have to echo each time
//can also do for results
//but won't
//but would if there were, like, more
//stupid Mike
//stupid Joe
//ugh
//hey!

