FROM debian:jessie

RUN apt update \
    && apt install -y wget

RUN wget http://snapshot.debian.org/archive/debian/20130319T033933Z/pool/main/o/openssl/libssl1.0.0_1.0.1e-2_amd64.deb -O /tmp/libssl1.0.0_1.0.1e-2_amd64.deb && \
 dpkg --ignore-depends=multiarch-support -i /tmp/libssl1.0.0_1.0.1e-2_amd64.deb

RUN wget http://snapshot.debian.org/archive/debian/20130319T033933Z/pool/main/o/openssl/openssl_1.0.1e-2_amd64.deb -O /tmp/openssl_1.0.1e-2_amd64.deb && \
 dpkg --ignore-depends=multiarch-support -i /tmp/openssl_1.0.1e-2_amd64.deb

RUN apt update \
    && apt install -y nginx

RUN openssl req -x509 -nodes -days 365 -subj "/C=CA/ST=QC/O=Company, Inc./CN=owasp.local" \
    -newkey rsa:2048 -keyout /etc/ssl/private/nginx-selfsigned.key \
    -out /etc/ssl/certs/nginx-selfsigned.crt;

RUN unlink  /etc/nginx/sites-enabled/default

CMD ["nginx", "-g", "daemon off;"]
