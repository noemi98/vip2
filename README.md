# Proyecto para VIP2CARS - Codeigniter 4

## Gestión de Vehículos y sus contactos
Este proyecto tiene el funcionamiento básico (CRUD) para gestionar los vehículos

## Importante para la puesta en marcha
- PHP 7.4 o superior
- Composer
- Base de datos MySQL
- Servidor local como **XAMPP**, **WAMP**

## Instrucciones
1. Clonar el repositorio o descargar el ZIP
2. Instalar dependencias con Composer
```bash
composer install
3. Configurar el archivo .env:
   - cp .env.example .env
   - Luego en el archivo se tendrá que configurar los siguientes datos:  
      database.default.hostname = <tu_host>  
database.default.database = <nombre_de_base_de_datos>  
database.default.username = <tu_usuario_de_base_de_datos>  
database.default.password = <tu_contraseña_de_base_de_datos>  
database.default.DBDriver = MySQLi  
database.default.port = 3306  



4. Generar la clave de aplicación
   - php spark keys:generate
5. Iniciar el servidor de desarrollo
   - php spark serve
  
Acceso localmente: http://localhost:8080

