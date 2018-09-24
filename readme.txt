1. 	run y build imagen de docker

		$ docker build -t test-api . 
		$ docker run -p 8000:8000 test-api 

2. 	abrir otra terminal e ingresar al bash de la maquina

		$ docker images
		$ docker run -it <image id> /bin/bash

3. 	en el bash de la maquina creada ejecutar el siguiente comando y
	buscar la direccion ip para acceder a la maquina (inet eth0)

		$ ifconfig -a

4. 	para utilizar el api desde otro entorno se debe reemplazar la ip por la de la 	maquina
	
		ejemplo: http://172.17.0.3:8000/api/me

x. 	si no esta corriendo el servicio, ejecutar en la maquina creada

		$ php artisan serve --host=0.0.0.0 --port=8000

