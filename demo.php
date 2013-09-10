<?php

if (!isset($_GET["type"])) {
  echo "1";
} else {
	$type = $_GET["type"];
	$cmd = "false";

	if ($type == "clockset") {
		#date format MMDDhhmm[[CC]YY][.ss]
		$date = $_GET["date"];

		#see the setclock.sh script
		$cmd = "echo $date > /tmp/clockset";

		#or if you're running apache as root...
		#(which is usually a bad idea)
		#$cmd = "date $date";
	} else if ($type == "cleanopenmrs") {
		$cmd = "mysql openmrs -u root -pPASSWORD -e \"update encounter set voided='1';\"";
	} else if ($type == "cleanopenxds") {
		$cmd = "export PGPASSWORD=\"openxds\" && psql openxds -U openxds < /home/jembi/openxds/misc/create_database_schema_postgres.sql";
	} else if ($type == "sendrapidsms") {
		$cmd = "/home/ryan/SmartBear/soapUI-4.5.1/bin/testrunner.sh -s\"SHR Service TestSuite\" -c\"encounters TestCase\" -utest -ptest -r -f/home/ryan/Programs/soapui-4.0.1/tests -I /home/ryan/Downloads/RapidSMS-to-HIM.xml";
	}

	$output = null;
	$returnValue = 1;
	exec($cmd, $output, $returnValue);
	echo "$returnValue";
}

?>
