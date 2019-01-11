FROM nginx

RUN apt-get update

RUN apt-get install -y acl

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/Oslo /etc/localtime
RUN "date"
