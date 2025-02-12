FROM debian:bookworm-slim

ARG HOSTNAME
ARG NETWORKS
ARG TIMEZONE

ENV TZ="${TIMEZONE}"

RUN echo "postfix postfix/myhostname string ${HOSTNAME}" | debconf-set-selections
RUN echo "postfix postfix/mailname string ${HOSTNAME}" | debconf-set-selections
RUN echo "postfix postfix/main_mailer_type string 'Internet Site'" | debconf-set-selections

RUN echo "${HOSTNAME}" > /etc/hostname
RUN echo "${HOSTNAME}" > /etc/mailname

RUN apt-get update && apt-get install -y build-essential vim unzip curl wget cron telnet nano inetutils-syslogd logrotate net-tools postfix

#RUN postconf -e 'smtpd_use_tls=yes'
#RUN postconf -e 'smtpd_tls_session_cache_database = btree:${data_directory}/smtpd_scache'

RUN postconf -e "mynetworks = 127.0.0.0/8 [::ffff:127.0.0.0]/104 [::1]/128 ${NETWORKS}"
RUN postconf -e "myhostname = ${HOSTNAME}"

ADD utils/rsyslog /tmp/rsyslog
ADD utils/init.sh /init.sh

EXPOSE 25

RUN chmod +x /init.sh

CMD ["/init.sh"]
