FROM nginx:alpine

ARG user
ARG uid

RUN addgroup --system --gid ${uid} ${user}
RUN addgroup nginx ${user}

COPY weather.conf /etc/nginx/conf.d/default.conf

EXPOSE 80