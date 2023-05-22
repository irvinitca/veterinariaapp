

<br/>


Si encuentras algún problema durante la configuración o ejecución del proyecto, asegúrate de revisar la documentación oficial de Laravel o consultar la comunidad de desarrollo para obtener ayuda adicional.


<!-- Improved compatibility of back to top link: See: https://github.com/othneildrew/Best-README-Template/pull/73 -->
<a name="readme-top"></a>
<!--
*** Thanks for checking out the Best-README-Template. If you have a suggestion
*** that would make this better, please fork the repo and create a pull request
*** or simply open an issue with the tag "enhancement".
*** Don't forget to give the project a star!
*** Thanks again! Now go create something AMAZING! :D
-->



<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->
[![Contributors][contributors-shield]][contributors-url]




<!-- PROJECT LOGO -->
<br />
<div align="center">

  <h3 align="center">Proyecto de Veterinaria </h3>

  <p align="center">
   Este proyecto es una aplicación de veterinaria que utiliza Laravel como framework de desarrollo. A continuación, se detallan los pasos necesarios para configurar el proyecto correctamente.
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>


  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project


La clínica veterinaria “Los animalitos” solicita una aplicación que le permita administrar todas sus consultas y pacientes.

•	Se requiere que los usuarios de la solución puedan iniciar sesión mediante un usuario y contraseña. Ningún usuario podrá visualizar ninguna pantalla ni realizar ninguna consulta si no ha sido validado su usuario y contraseña. 
•	Se requiere una pantalla que permita el registro de los datos más importantes de los clientes (humanos).
•	Se requiere una pantalla que permita el registro de los pacientes.
•	Se requiere una pantalla que permita generar una cita. Se debe registrar fecha, hora, veterinario asignado (no le deben chocar sus consultas), motivo de la consulta. Esta pantalla será utilizada por la persona recepcionista de la clínica.
•	Se requiere una pantalla en la que el veterinario pueda registrar su diagnóstico, sus indicaciones y el medicamento recetado. Cada veterinario solo podrá ver la lista de pacientes asignados.
•	Se requiere una pantalla donde la persona encargada de recepción pueda dar de alta al paciente y hacer el cobro respectivo al cliente. Esta pantalla solo la podrá visualizar el usuario con el privilegio.
•	Los clientes pueden solicitar la programación de futuras citas (no necesariamente deben asignar al veterinario).
•	Se requiere un módulo para la generación de reportes. Este módulo solo lo podrá visualizar un usuario con el privilegio.
•	El historial médico de cada paciente debe quedar registrado y disponible siempre



<p align="right">(<a href="#readme-top">back to top</a>)</p>



### Built With

This section should list any major frameworks/libraries used to bootstrap your project. Leave any add-ons/plugins for the acknowledgements section. Here are a few examples.


* [![Laravel][Laravel.com]][Laravel-url]
* [![Bootstrap][Bootstrap.com]][Bootstrap-url]


<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Getting Started

This is an example of how you may give instructions on setting up your project locally.
To get a local copy up and running follow these simple example steps.

### Prerequisites


PHP 8.1 o superior
Composer
MySQL

### Installation


1. Clonar repositorio
   ```sh
   git clone https://github.com/irvinitca/veterinariaapp.git
   ```
2. Instalar Dependencias de Composer
   ```sh
   composer install
   ```
3. Crea una base de datos en MySQL llamada dbveterinaria

4. Correr Migraciones en el proyecto con 
   ```sh
   php artisan migrate
   ```
5. Correr Seed para datos de usuarios y roles
   ```sh
   php artisan db:seed
   ```
6. Correr Servidor
   ```sh
   php artisan serve
   ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>














<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/othneildrew/Best-README-Template.svg?style=for-the-badge
[contributors-url]: https://github.com/othneildrew/Best-README-Template/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/othneildrew/Best-README-Template.svg?style=for-the-badge
[forks-url]: https://github.com/othneildrew/Best-README-Template/network/members
[stars-shield]: https://img.shields.io/github/stars/othneildrew/Best-README-Template.svg?style=for-the-badge
[stars-url]: https://github.com/othneildrew/Best-README-Template/stargazers
[issues-shield]: https://img.shields.io/github/issues/othneildrew/Best-README-Template.svg?style=for-the-badge
[issues-url]: https://github.com/othneildrew/Best-README-Template/issues
[license-shield]: https://img.shields.io/github/license/othneildrew/Best-README-Template.svg?style=for-the-badge
[license-url]: https://github.com/othneildrew/Best-README-Template/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/othneildrew
[product-screenshot]: images/screenshot.png
[Next.js]: https://img.shields.io/badge/next.js-000000?style=for-the-badge&logo=nextdotjs&logoColor=white
[Next-url]: https://nextjs.org/
[React.js]: https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB
[React-url]: https://reactjs.org/
[Vue.js]: https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vuedotjs&logoColor=4FC08D
[Vue-url]: https://vuejs.org/
[Angular.io]: https://img.shields.io/badge/Angular-DD0031?style=for-the-badge&logo=angular&logoColor=white
[Angular-url]: https://angular.io/
[Svelte.dev]: https://img.shields.io/badge/Svelte-4A4A55?style=for-the-badge&logo=svelte&logoColor=FF3E00
[Svelte-url]: https://svelte.dev/
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com
[JQuery.com]: https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white
[JQuery-url]: https://jquery.com 