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
