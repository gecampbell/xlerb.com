#!/bin/bash

OUTPUT=./output

if [[ -z "$1" ]]; then
	echo "Usage: push.sh {destination}"
	exit;
fi

if [[ ! -d $OUTPUT ]]; then
	echo "$OUTPUT directory does not exist"
	exit;
fi

rsync -aprv --delete $OUTPUT/* $1
