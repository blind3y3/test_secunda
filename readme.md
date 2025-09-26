# Установка

## Короткий путь

1. Поставить https://taskfile.dev/
2. Выполнить `task install` в директории с файлом [taskfile.yml](taskfile.yml)

## Вручную

Шаг 1:

```bash
cp .env.example .env && docker compose up --build -d
```

Шаг 2:

```bash
docker compose exec php cp .env.example .env && \
docker compose exec php composer install && \
docker compose exec php chmod -R 775 storage && \
docker compose exec php chmod -R 775 bootstrap/cache && \
docker compose exec php php artisan key:generate && \
docker compose exec php php artisan storage:link && \
docker compose exec php php artisan migrate --seed
```

### Опционально, если появляется ошибка про permissions

```bash
sudo chown $USER:$USER app
```

## Использование статического API ключа

В app/.env при необходимости задаем свой ключ:

```env
X_API_KEY=ВашКлюч
```

В заголовках запроса передаем ключ `X-API-KEY`

## Документация доступна по адресу:

```
http://localhost:8080/swagger/index.html
```

Чтобы сгенерировать новую версию документации, после изменений атрибутов в консоли выполнить:

```bash
docker compose exec php php vendor/bin/openapi Modules/ -o docs/openapi.yaml
```

Или

```bash
task docs
```