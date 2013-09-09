#!/bin/bash
# Usage: run this script using the watch command; e.g.
# sudo watch ./setclock.sh

if [ -f "/tmp/clockset" ]; then
	echo "Setting date";
	date `cat /tmp/clockset`;
	rm -f /tmp/clockset;
	sudo service ntp restart;
fi
