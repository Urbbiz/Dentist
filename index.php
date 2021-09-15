<?php

echo "Hello If you want register please follow instructions below","\n";
echo "Please enter your national ID number","\n";

$nationalId = trim(fgets(STDIN,1024));

echo "your national ID number is $nationalId.";
