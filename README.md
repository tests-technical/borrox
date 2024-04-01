# borrox

# Inicializar front

```bash
cd front
npm install
npm start
```

`http://localhost:4321/`

# Inicializar back

```bash
cd back
make dev.backend
php bin/console lexik:jwt:generate-keypair
php bin/console doctrine:migrations:migrate
```

`http://localhost:8000/`

# API

## Registro de usuario

```bash
POST: http://localhost:8000/api/registration
{
    "email": "example@gmail.com",
    "password": "123456"
}
```

## Login de usuario

```bash
POST: http://localhost:8000/api/login
{
    "email": "example@gmail.com",
    "password": "123456"
}
```

## Convertir moneda

```bash
POST: http://localhost:8000/api/currency/converter
{
    "amount": 100,
    "from": "USD",
    "to": "EUR"
}
```
