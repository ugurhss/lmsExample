
## Docker ile Çalıştırma

1. Konteynerleri ayağa kaldır:

```bash
docker compose up -d --build
```

2. Uygulama bağımlılıklarını yükle:

```bash
docker compose exec app composer install
```

3. `.env` içinde DB ayarlarını Docker'a göre güncelle:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=lmsexample
DB_USERNAME=lms
DB_PASSWORD=ServBay.dev
```

4. Uygulama key ve migration:

```bash
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
```

5. Uygulama:

- URL: `http://localhost:8000`
- API örneği: `http://localhost:8000/api/quizzes`

## Docker Dosyaları Ne İşe Yarıyor?

- `Dockerfile` app php fpm containerini olusturur php 8.3 ve composer burada kurulur verisoyon bilgileri buradan verilir
- `docker-compose.yml` servisleri birlikte calistirir app laravel php web nginx 8000 port db mysql localhost 3307 
- `docker/nginx/default.conf` nginx laravel ayaridir public dizinini kok alir php isteklerini app 9000 servisine iletir(projeyi canlıya almak istedigimizde de public kök dizin olur)
- `.dockerignore` build sirasinda gereksiz dosyalari disarida tutar
(jenkis bagladıgımda githuptan cekip testleri calıştırdıgın da hız kazanmak için  )
