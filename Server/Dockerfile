FROM ubuntu:latest
MAINTAINER MSTU STANKIN 'lead_of_digit@gmail.com'
RUN sudo apt-get update -y
RUN apt-get install -y python-pip python-dev build-essential
COPY . /app
WORKDIR /app
RUN pip install -r requirements.txt
ENTRYPOINT ['python']
CMD ['app.py']