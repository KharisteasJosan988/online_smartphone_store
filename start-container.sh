#!/bin/bash
set -e

if [ "$IS_LARAVEL" = "true" ]; then
  if [ "$RAILPACK_SKIP_MIGRATIONS" != "true" ]; then
    echo "Running migrations and seeding database ..."
    php artisan migrate --force
    php artisan db:seed --force
  fi

  php artisan storage:link || true

  php artisan optimize:clear
  php artisan config:cache
  php artisan event:cache
  php artisan view:cache
  # NOTE: route:cache sengaja DILEWATI — command ini memicu infinite
  # recursion pada kombinasi versi Laravel/serializable-closure di project
  # ini dan bikin container crash (OOM / segfault) berulang. Aplikasi
  # tetap berjalan normal tanpa route cache, cuma tanpa optimasi performa
  # routing itu (dampaknya nyaris tidak terasa untuk skala aplikasi ini).

  echo "Starting Laravel server ..."
fi

# Start the FrankenPHP server
docker-php-entrypoint --config /Caddyfile --adapter caddyfile 2>&1
