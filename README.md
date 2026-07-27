# Casa do Barista

Projeto aula a aula da turma **TIPI 06**, desenvolvido com **Laravel**, **Docker**, **Nginx** e **MySQL**.

Este documento mostra como baixar, configurar e executar o projeto em uma máquina virtual Linux.

---

## 1. Estrutura do projeto

```text
casa-barista
├── docker
│   └── nginx
│       └── default.conf
├── src
│   ├── app
│   ├── database
│   ├── public
│   ├── resources
│   ├── routes
│   ├── storage
│   ├── artisan
│   └── composer.json
├── Dockerfile
└── docker-compose.yml
```

- `docker/`: configurações da infraestrutura.
- `src/`: aplicação Laravel.
- `docker-compose.yml`: organiza os containers.
- `Dockerfile`: prepara o ambiente PHP da aplicação.

> A pasta `docker` cuida do ambiente. A pasta `src` cuida da aplicação.

---

## 2. Tecnologias utilizadas

- Linux na máquina virtual
- Git
- Docker
- Docker Compose
- Nginx
- PHP
- Laravel
- MySQL
- phpMyAdmin, quando configurado no `docker-compose.yml`

---

## 3. Verificar o ambiente

Abra o terminal da máquina virtual e execute:

```bash
git --version
docker --version
docker compose version
```

Se os três comandos mostrarem uma versão, o ambiente está pronto.

Também confirme que o Docker está funcionando:

```bash
docker ps
```

---

## 4. Baixar o projeto do GitHub

Escolha uma pasta dentro do Linux para guardar o projeto:

```bash
cd ~
```

Clone o repositório:

```bash
git clone https://github.com/allepalmeira/casa-barista.git
```

Entre na pasta:

```bash
cd casa-barista
```

Confira os arquivos:

```bash
ls
```

Devem aparecer, entre outros:

```text
docker
src
Dockerfile
docker-compose.yml
```

---

## 5. Criar o arquivo `.env`

O Laravel usa o arquivo `src/.env` para guardar as configurações da aplicação e do banco.

Verifique se ele já existe:

```bash
ls -la src
```

Se o arquivo `.env` não existir, crie uma cópia do exemplo:

```bash
cp src/.env.example src/.env
```

Abra o arquivo no VS Code:

```bash
code src/.env
```

Confira principalmente estas configurações:

```env
APP_NAME="Casa do Barista"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=casa_barista
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

> Dentro do Docker, o host do banco não é `localhost`. O host é o nome do serviço: `mysql`.

---

## 6. Construir e iniciar os containers

Na raiz do projeto, execute:

```bash
docker compose up -d --build
```

Depois confira o estado dos serviços:

```bash
docker compose ps
```

Os serviços principais devem aparecer como iniciados, por exemplo:

```text
casa-barista-app
casa-barista-nginx
casa-barista-mysql
```

Se o phpMyAdmin estiver configurado, também aparecerá:

```text
casa-barista-phpmyadmin
```

---

## 7. Instalar as dependências do Laravel

Neste projeto, o serviço PHP se chama `app`.

Execute:

```bash
docker compose exec app composer install
```

Depois gere a chave da aplicação:

```bash
docker compose exec app php artisan key:generate
```

Limpe as configurações antigas:

```bash
docker compose exec app php artisan config:clear
```

---

## 8. Corrigir permissões, se necessário

Se aparecer erro de escrita em `storage`, `bootstrap/cache`, `.env` ou `tempnam()`, execute:

```bash
sudo chown -R $USER:$USER .
chmod -R 775 src/storage
chmod -R 775 src/bootstrap/cache
```

Depois reinicie os containers:

```bash
docker compose restart
```

---

## 9. Criar as tabelas do banco

Execute as migrations:

```bash
docker compose exec app php artisan migrate
```

Se o projeto possuir seeders preparados para dados iniciais:

```bash
docker compose exec app php artisan db:seed
```

Para executar migrations e seeders juntos em um banco vazio:

```bash
docker compose exec app php artisan migrate --seed
```

---

## 10. Acessar o projeto

### Aplicação Laravel

No navegador da própria máquina virtual:

```text
http://localhost:8000
```

### phpMyAdmin

Quando o serviço estiver configurado no `docker-compose.yml`:

```text
http://localhost:8081
```

Dados de acesso do banco:

```text
Usuário: laravel
Senha: laravel
Banco: casa_barista
Servidor: mysql
```

Também é possível entrar como administrador:

```text
Usuário: root
Senha: root
```

---

## 11. Acessar pelo Windows

Para abrir o projeto no navegador do Windows, descubra o IP da máquina virtual:

```bash
hostname -I
```

Exemplo de resultado:

```text
192.168.0.120
```

No navegador do Windows, use o IP mostrado pela sua VM:

```text
http://192.168.0.120:8000
```

Para o phpMyAdmin:

```text
http://192.168.0.120:8081
```

Se não abrir, verifique a configuração de rede da máquina virtual, como modo Bridge ou redirecionamento de portas no modo NAT.

---

## 12. Comandos úteis

### Ver os containers

```bash
docker compose ps
```

### Iniciar o projeto

```bash
docker compose up -d
```

### Parar e remover os containers

```bash
docker compose down
```

### Reiniciar os serviços

```bash
docker compose restart
```

### Ver os logs do PHP

```bash
docker compose logs app
```

### Ver os logs do Nginx

```bash
docker compose logs nginx
```

### Ver os logs do MySQL

```bash
docker compose logs mysql
```

### Ver os logs do phpMyAdmin

```bash
docker compose logs phpmyadmin
```

### Entrar no container da aplicação

```bash
docker compose exec app bash
```

### Acessar o MySQL pelo terminal

```bash
docker compose exec mysql mysql -ularavel -plaravel casa_barista
```

Para sair do MySQL:

```sql
EXIT;
```

---

## 13. Atualizar o projeto nas próximas aulas

Entre na pasta do projeto:

```bash
cd ~/casa-barista
```

Confira se existem alterações locais:

```bash
git status
```

Baixe as atualizações do GitHub:

```bash
git pull origin main
```

Atualize as dependências, quando necessário:

```bash
docker compose exec app composer install
```

Execute novas migrations:

```bash
docker compose exec app php artisan migrate
```

Reinicie o ambiente:

```bash
docker compose up -d
```

---

## 14. Resolução de problemas

### O comando `docker compose exec` não funciona

Primeiro confirme se o serviço está rodando:

```bash
docker compose ps
```

Se estiver parado:

```bash
docker compose up -d
```

### O container PHP não inicia

```bash
docker compose logs app
```

### A página não abre no navegador

Verifique o Nginx:

```bash
docker compose logs nginx
```

Confira também se a porta `8000` está publicada:

```bash
docker compose ps
```

### O Laravel não conecta ao banco

Confira o `src/.env`:

```env
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=casa_barista
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

Depois limpe o cache:

```bash
docker compose exec app php artisan config:clear
```

### Erro de permissão no Laravel

```bash
sudo chown -R $USER:$USER .
chmod -R 775 src/storage
chmod -R 775 src/bootstrap/cache
```

### A porta já está sendo usada

No `docker-compose.yml`, altere a porta do lado esquerdo.

Exemplo:

```yaml
ports:
  - "8081:80"
```

- Porta da esquerda: máquina virtual.
- Porta da direita: container.

---

## 15. Fluxo da aplicação

```text
Navegador
   ↓
Nginx
   ↓
PHP / Laravel
   ↓
MySQL
```

O navegador acessa o Nginx. O Nginx encaminha a requisição para a aplicação Laravel. Quando necessário, o Laravel consulta ou grava informações no MySQL.

---

## 16. Checklist final

Antes de começar a atividade, confirme:

- [ ] O projeto foi clonado.
- [ ] O terminal está na pasta `casa-barista`.
- [ ] O arquivo `src/.env` existe.
- [ ] O banco usa `DB_HOST=mysql`.
- [ ] Os containers aparecem em `docker compose ps`.
- [ ] O Composer foi executado.
- [ ] A chave do Laravel foi gerada.
- [ ] As migrations foram executadas.
- [ ] O projeto abre em `http://localhost:8000`.
- [ ] O phpMyAdmin abre em `http://localhost:8081`, quando configurado.

---

## Projeto educacional

Este repositório é utilizado como projeto aula a aula da turma **TIPI 06**, com foco no aprendizado de desenvolvimento back-end, Laravel, banco de dados, Docker e trabalho colaborativo com Git.
