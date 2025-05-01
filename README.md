# Proyecto para VIP2CARS - Codeigniter 4

## Gestión de Vehículos y sus contactos
Este proyecto tiene el funcionamiento básico (CRUD) para gestionar los vehículos

## Importante para la puesta en marcha
- PHP 8.1 o superior
- Composer
- Base de datos MySQL
- Servidor local como **XAMPP**, **WAMP**

## Instrucciones
1. **Clonar el repositorio o descargar el ZIP**

   Para clonar el repositorio, ejecuta el siguiente comando:

   ```bash
   git clone https://github.com/noemi98/vip2.git

2. **Instalar dependencias con Composer**

   Para instalar las dependencias de Composer, ejecuta el siguiente comando en tu terminal:

   ```bash
   composer install

3. **Configurar el archivo .env:**
   - Copia el archivo de ejemplo `.env.example` a un nuevo archivo `.env`:

     ```bash
     cp .env.example .env
     ```

   - Luego, abre el archivo `.env` y configura los siguientes parámetros:

     ```ini
     database.default.hostname = <host>
     database.default.database = <nombre_de_base_de_datos>
     database.default.username = <usuario_de_base_de_datos>
     database.default.password = <contraseña_de_base_de_datos>
     database.default.DBDriver = MySQLi
     database.default.port = 3306  
     ```

   - No olvidar, ejecutar el Script de la BBDD (vip2cars.sql), y en base a ello, modificar los parámetros anteriores.

5. **Generar la clave de aplicación**
   ```bash
   php spark keys:generate

7. **Iniciar el servidor de desarrollo**
   ```bash
   php spark serve
  
Acceso localmente: http://localhost:8080

