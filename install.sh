#!/bin/sh

rsync -aprv index.html css img js \
	root@rack2.broadpool.net:/var/www/vhosts/xlerb.com/
ssh root@rack2.broadpool.net 'chown -R apache:apache /var/www/vhosts/xlerb.com'
