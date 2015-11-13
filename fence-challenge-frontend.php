<!DOCTYPE html>
<?php
require 'fence-challenge.php';
?>

<html>
<body>
        <form method="GET" action="<?php $_SERVER['PHP_SELF'] ?>">
            <label>Enter Number of Poles You Have: <input type="number" name="posts" placeholder="Enter Text..." ></label>
            <label>Enter Number of Rails You Have: <input type="number" name="rails" placeholder="Enter Text..."></label>
            <p> OR: </p>
            <label>Enter Number Distance of Fence You Wish to Build: <input type="text" name="length" placeholder="Enter Text..."></label>
            <input type="submit" value="Submit">
        </form>
        <p><?php echo $returnLength; ?></p>
        <p><?php echo $returnResources; ?></p>
        <p><?php echo $errorNeedMoreResources; ?></p>
        <p><?php echo $errorInvalidLength; ?></p>
</body>
</html>

