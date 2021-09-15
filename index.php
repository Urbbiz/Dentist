<?php

echo "Hello If you want register for appointment, please enter: 1 ","\n";
echo "If you are medical personnel, please enter: 2 ","\n";

$input = trim(fgets(STDIN,10));

switch ($input)
{
    case 1;
        echo "Please enter your national ID number","\n";
        $nationalId = trim(fgets(STDIN,1024));
        echo "your national ID number is $nationalId.";

        break;
    case  2;
        echo "You reached medical personnel data";

}


