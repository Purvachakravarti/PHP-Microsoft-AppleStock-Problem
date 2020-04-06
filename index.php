function getMaxProfit($stockPrices)
{
    $arr = array();
    echo sizeof($stockPrices);
    if(sizeof($stockPrices) == 0)
        throw new Exception("exception with empty prices");
    else  if(sizeof($stockPrices) == 1)
        throw new Exception("exception with one price");

        if(sizeof($stockPrices) > 1)
        {
             // calculate the max profit
             $max = max($stockPrices);
             $min = min($stockPrices);
            if($min < $max && array_search($min,$stockPrices) < array_search($max,$stockPrices))
             return $max-$min;
            for($i = 0; $i<count($stockPrices); $i++)
            {
                if($i < array_search($max,$stockPrices))
                {
                    $diff = $max - $stockPrices[$i] ;
                     array_push($arr, $diff);
                }
                 
            }
            if( sizeof($arr) > 0 )
                return max($arr);
            if(array_search($max,$stockPrices) == 0 && $max != $stockPrices[array_search($max,$stockPrices)+1])
                 return -2;
            else 
                return 0;
        }
        
    
    
    
    
    return 0;
}


















// tests

$desc = 'price goes up then down';
$actual = getMaxProfit([1, 5, 3, 2]);
$expected = 4;
assertEqual($actual, $expected, $desc);

$desc = 'price goes down then up';
$actual = getMaxProfit([7, 2, 8, 9]);
$expected = 7;
assertEqual($actual, $expected, $desc);

$desc = 'price goes up all day';
$actual = getMaxProfit([1, 6, 7, 9]);
$expected = 8;
assertEqual($actual, $expected, $desc);

$desc = 'price goes down all day';
$actual = getMaxProfit([9, 7, 4, 1]);
$expected = -2;
assertEqual($actual, $expected, $desc);

$desc = 'price stays the same all day';
$actual = getMaxProfit([1, 1, 1, 1]);
$expected = 0;
assertEqual($actual, $expected, $desc);

$desc = 'exception with empty prices';
$emptyArray = function() {
    getMaxProfit([]);
};
assertThrowsException($emptyArray, $desc);

$desc = 'exception with one price';
$onePrice = function() {
    getMaxProfit([1]);
};
assertThrowsException($onePrice, $desc);

function assertEqual($a, $b, $desc)
{
    if ($a === $b) {
        echo "$desc ... PASS\n";
    } else {
        echo "$desc ... FAIL: $a != $b\n";
    }
}

function assertThrowsException($func, $desc)
{
    try {
        $func();
        echo "$desc ... FAIL\n";
    } catch (Exception $e) {
        echo "$desc ... PASS\n";
    }
}
