FROM node:22-alpine
# Créer un conteneur Node.js et démarrer une session Shell :
WORKDIR /var/www/mink
COPY --link --chmod=755 docker-entrypoint.sh /usr/local/bin/docker-entrypoint
COPY . /var/www/mink

ENTRYPOINT ["docker-entrypoint"]
