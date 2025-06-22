#!/bin/bash

if ! docker info > /dev/null 2>&1; then
  echo "Error: Docker no está corriendo. Por favor, inicia Docker y vuelve a intentarlo."
  exit 1
fi

echo "--- Iniciando configuración del proyecto ---"
cd src/
echo "--- Paso 1/4: Instalando dependencias de Node.js ---"
npm install

echo "--- Paso 2/4: Compilando assets de frontend (npm build) ---"
npm run build

echo "--- Paso 3/4: Levantando contenedores Docker (docker compose up -d) ---"
cd ..
docker compose stop
docker compose up -d

echo "Esperando a que los servicios de Docker estén listos (esto puede tardar unos segundos)..."
sleep 5

echo "--- Paso 4/4: Instalando dependencias de PHP (composer install) y ejecutando migraciones ---"
docker compose exec php sh -c "composer install && php bin/console doctrine:migrations:migrate --no-interaction && php bin/console cache:clear"

echo "--- Configuración del proyecto completada ---"
echo "Corriendo en http://localhost:8080/"