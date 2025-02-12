#!/bin/bash -e

if [ -e /tmp/rsyslog ]; then
  mv /tmp/rsyslog /etc/logrotate.d/
fi

/etc/init.d/inetutils-syslogd start
/etc/init.d/cron start

/etc/init.d/postfix start

tail -f /dev/null
