# HtmlTable

For personal usage.

Usage example:

```php

use Ainars\HtmlTable\Manager;

require "vendor/autoload.php";

$manager = new Manager();

$table = $manager->buildEmptyTable(2, 4);
$table->setCaption("Test");
$table->getRow(0)->getCell(0)->setContent("Nr");
$table->getRow(0)->getCell(1)->setContent("Names")->setColspan(2);
$table->getRow(0)->getCell(3)->setContent("Age");

$table->getRow(1)->getCell(0)->setContent("1");
$table->getRow(1)->getCell(1)->setContent("Peter");
$table->getRow(1)->getCell(2)->setContent("Mustermann");
$table->getRow(1)->getCell(3)->setContent("22");

$manager->print2Console($table);

$normal = $manager->normalize($table);
$normal->getRow(0)->makeHeading();
$manager->print2Console($normal);

```

Output 1:

    <<Test>>
    Table: 4x2
    Nr             	Names          	               	Age            
    1              	Peter          	Mustermann     	22             

Output 2:

    Table: 4x2
    ------------------------------------------------------------
    Nr             	Names          	Names          	Age            
    ------------------------------------------------------------
    1              	Peter          	Mustermann     	22             
