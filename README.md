# HtmlTable

For personal usage.

Usage:
	$manager = new Manager;
	$normal = $manager->normalize($table);
	$normal->getRow(0)->makeHeading();
	$manager->print2Console($normal);