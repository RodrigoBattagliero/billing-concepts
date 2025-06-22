#!/bin/bash

if ! docker info > /dev/null 2>&1; then
  echo "Error: Docker no está corriendo. Por favor, inicia Docker y vuelve a intentarlo."
  exit 1
fi

echo "--- Iniciando configuración del proyecto ---"
cd src/
echo "--- Paso 1/4: Instalando dependencias de Node.js (yarn install) ---"
if ! command -v yarn &> /dev/null; then
    echo "Advertencia: 'yarn' no está instalado. Intentando con 'npm'."
    if ! command -v npm &> /dev/null; then
        echo "Error: Ni 'yarn' ni 'npm' están instalados. Por favor, instala Node.js y un gestor de paquetes (yarn o npm) en tu máquina local."
        exit 1
    fi
    npm install
else
    yarn install
fi

# 3. Compilar los assets de frontend
echo "--- Paso 2/4: Compilando assets de frontend (yarn build) ---"
if ! command -v yarn &> /dev/null; then
    npm run build
else
    yarn build
fi

# 4. Levantar los contenedores de Docker
echo "--- Paso 3/4: Levantando contenedores Docker (docker compose up -d) ---"
cd ..
docker compose up -d

# Esperar un momento para asegurar que los servicios estén inicializados
echo "Esperando a que los servicios de Docker estén listos (esto puede tardar unos segundos)..."
sleep 10 # Ajusta este tiempo si tus contenedores tardan más en iniciarse

# 5. Entrar al contenedor PHP e instalar dependencias de Composer
echo "--- Paso 4/4: Instalando dependencias de PHP (composer install) y ejecutando migraciones ---"
docker compose exec php sh -c "composer install && php bin/console doctrine:migrations:migrate --no-interaction && php bin/console cache:clear"

echo "--- Configuración del proyecto completada ---"
echo "Corriendo en https://localhost:8080/"