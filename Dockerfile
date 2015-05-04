# Nhz docker image
#
# to use:
#
# 1. install docker, see docker.com
# 2. clone the git repo including this Dockerfile
# 3. build the container with ```docker build -t nxt .```
# 4. run the created nhz container with ```docker run -d -p 127.0.0.1:7776:7776 -p 127.0.0.1:7774:7874 nhz```
# 5. inspect with docker logs (image hash, find out with docker ps, or assign a name

FROM phusion/baseimage
# start off with standard ubuntu images

#java7
RUN sed 's/main$/main universe/' -i /etc/apt/sources.list
RUN apt-get update && apt-get install -y software-properties-common python-software-properties
RUN add-apt-repository ppa:webupd8team/java -y
RUN apt-get update
RUN apt-get install -y wget unzip
RUN echo oracle-java7-installer shared/accepted-oracle-license-v1-1 select true | /usr/bin/debconf-set-selections
RUN apt-get install -y oracle-java7-installer

# run and compile nhz
RUN mkdir /nhz
ADD . /nhz
# repo has
ADD docker_start.sh /docker_start.sh
RUN chmod +x /docker_start.sh

RUN cd /nhz; ./compile.sh
# both Nhz ports get exposed
EXPOSE 7774 7776
CMD ["/docker_start.sh"]
