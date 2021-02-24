FROM php:7.2-apache
#COPY ./ /var/www/html
RUN cd /var/www/html && \
chmod -R 777 /var/www/html && chown root:root /var/www/html

EXPOSE 80