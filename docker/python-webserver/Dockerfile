FROM python:3.9.10-slim-buster
ADD static/ /src
WORKDIR /src
EXPOSE 8081
CMD python3 -m http.server 8081
