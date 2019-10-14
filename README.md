# api-event

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install api-event
```
## Endpoints

### `GET APIHOST/event/object`

Mengambil semua object vanue yang terdaftar. Endpoint ini menerima quer parameter ( page, rpp, month ). Selain itu juga menerima query string `q` untuk memfilter object event berdasarkan nama.

### `GET APIHOST/event/object/(id|slug)`