![logo](https://github.com/FedeTusa/Recetize/assets/80929186/f42f8ec1-7c52-4ba6-8510-5b94f469eeb8)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![HTML](https://img.shields.io/badge/HTML-239120?style=for-the-badge&logo=html5&logoColor=white)
![CSS](https://img.shields.io/badge/CSS-239120?&style=for-the-badge&logo=css3&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![JavaScrip](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
# Recetize
Es una aplicación creada con la finalidad de poder procesar y gestionar recetas medicas que deben ser archivadas por la ley para futuras auditorias. Cuenta con una interfaz que permite al farmacéutico cargar, buscar, modificar y eliminar pacientes, remedios, médicos y recetas.

<img src="https://github.com/user-attachments/assets/65c8ce6b-c8d2-40fd-bb52-a3c94119acb8" alt="pantalla principal" width="700"/>

## Instalación
### Entorno de Desarrollo: Laragon

Este proyecto ha sido levantado utilizando **[Laragon](https://laragon.org/)**, un entorno de desarrollo local ligero, rápido y potente. Laragon está diseñado para hacer que trabajar con aplicaciones web sea sencillo y eficiente, con soporte para servidores como Apache, Nginx, bases de datos (MySQL, MariaDB), y lenguajes como PHP, Node.js, Python, entre otros.

#### ¿Qué es Laragon?
Laragon es una plataforma de desarrollo local que ofrece una instalación rápida y automática de todo lo necesario para desarrollar aplicaciones web sin tener que configurar cada herramienta manualmente. Entre sus principales características destacan:
- Entorno preconfigurado listo para usar (LAMP/LEMP).
- Capacidad para manejar múltiples versiones de PHP y otros lenguajes.
- Integración con bases de datos y servidores.
- Ligero y rápido, ideal para desarrollo en equipos con pocos recursos.
- Fácil integración con herramientas como Composer y npm.

Puedes descargar Laragon desde su sitio web oficial: [Laragon Download](https://laragon.org/download/).

### Clonar el proyecto
El proyecto debe clonarse en la carpeta www de Laragon e instalar composer con el siguiente comando
- `composer install`

### Cómo levantar la API
Ejecutar los siguientes comandos:
- `cd recetize`
- `cd api-rest`
- `php -S localhost:8000 -t public`
