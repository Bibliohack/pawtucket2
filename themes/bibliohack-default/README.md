Este tema de Collective Access contiene [Webpack](https://webpack.js.org/) y [Sass](https://sass-lang.com/) para facilitar el desarrollo. Más información sobre la instalación [aquí](https://wecode101.com/how-to-install-webpack-to-a-php-project)


### Cómo correr webpack para que tome los cambios de los archivos scss

- Abrir una consola bash
- Pararse sobre la carpeta del tema (por ej.: `cd themes/bibliohack-default`)
- Buildear webpack `npm run build`
- Listo!


### Cómo crear un nuevo tema que contenga webpack

- Copiar el tema `bibliohack-default` (la carpeta completa) dentro de la carpeta /themes
- Renombrar el tema
- Dentro del archivo `package.json`, buscar la variable "name" y ponerle el nombre del tema (el mismo que le pusimos en la carpeta)
    - Opcional: Se le puede cambiar la descripción para que coincida con lo que contiene ese tema
- En el archivo setup.php en el root de pawtucket, cambiar la variable `$_CA_THEMES_BY_DEVICE` y asignarle el nombre del nuevo tema
- En consola, pararse en el nuevo tema
- Correr `npm install`
- Correr `npm run build`
- Listo!

### Cómo instalar nuevas dependencias
#### Opción 1:
- En el package.json en el root del tema agregar en devDependencies la dependencia que se desea agregar con una versión mínima
- En la consola (parados sobre el tema) correr `npm install`

#### Opción 2:
- En la consola (parados sobre el tema) usar npm para instalar la dependencia deseaba (ej.: `npm install bootstrap`)