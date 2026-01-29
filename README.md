# Mini ERP

Un sistema de gestión simple (ERP) construido con PHP nativo y MySQL, siguiendo una estructura MVC básica.

## Requisitos

- PHP 7.4 o superior
- MySQL / MariaDB
- Servidor web (Apache/Nginx) - Preconfigurado para XAMPP

## Instalación

1. **Base de Datos**
    - Crea una base de datos llamada `mini_erp` en tu MySQL local.
    - Ejecuta el script de migración para crear la tabla de usuarios:
      `database/migrations/001_create_users_table.sql`
    - Ejecuta el script para la tabla de clientes/proveedores:
      `database/migrations/002_create_partners_table.sql`

2. **Configuración**
    - El archivo de configuración principal está en `app/config/config.php`.
    - La configuración de la base de datos está en `app/config/database.php`. Ajusta las credenciales si tu usuario de MySQL no es `root` sin contraseña.

## Login

El sistema cuenta con autenticación de usuarios.
25: 
26: ## Funcionalidades
27: 
28: - **Autenticación**: Login y sesiones seguras.
29: - **Clientes / Proveedores**: CRUD completo con buscador para gestionar socios comerciales.



## Estructura del Proyecto

```
mini-erp/
├── app/
│   ├── config/      # Configuración (DB, constantes)
│   ├── helpers/     # Funciones auxiliares (Auth, etc)
│   ├── views/       # Vistas y layouts (Header, Footer)
├── database/
│   └── migrations/  # Scripts SQL
├── public/          # Directorio raíz público
│   ├── index.php    # Página de inicio (Dashboard)
│   ├── login.php    # Formulario de login
│   ├── logout.php   # Lógica de cierre de sesión
│   ├── partners.php # Controlador de Clientes/Proveedores

```

## Desarrollo

- **Core:** PHP Sin frameworks pesados.
- **Frontend:** Bootstrap 5.
- **Seguridad:** Contraseñas hasheadas con `password_hash`, Sesiones PHP.
