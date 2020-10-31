Развертывание сервера сбора и обработки

docker build -t flask_app:v0.1 Server/
docker run -d -p 46055:46055 flask_app:v0.1
