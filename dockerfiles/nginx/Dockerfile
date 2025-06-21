FROM nginx:1.28.0-alpine

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

RUN addgroup -g ${GID} --system symfony
RUN adduser -G symfony --system -D -s /bin/sh -u ${UID} symfony
RUN sed -i "s/user  nginx/user symfony/g" /etc/nginx/nginx.conf

ADD ./default.conf /etc/nginx/conf.d/

RUN mkdir -p /var/www/html