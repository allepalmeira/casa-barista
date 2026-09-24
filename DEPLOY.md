# Implantação: tipi06.smpsistema.com.br/barista

Servidor: Plesk, PHP 8.4, MySQL (banco `tipi06_casa_barista`).
O repositório tem o Laravel dentro de `src/`.

## Como fica no servidor

```
~/casa-barista/                  <- repositório (fora da pasta pública do site)
   └── src/                      <- Laravel (app, vendor, .env, storage...)
         └── public/             <- única parte que o navegador acessa
~/<pasta-raiz-do-site>/barista   <- atalho (link) para ~/casa-barista/src/public
```

Assim o `.env`, o `vendor` e o código **não** ficam acessíveis pela internet.
A pasta raiz do site aparece em **Hospedagem & DNS › Configurações de hospedagem ›
Raiz do documento** (ex.: `httpdocs` ou `tipi06.smpsistema.com.br`).

---

## Primeira instalação

### 1. Banco de dados
1. Plesk › **Bancos de dados** › `tipi06_casa_barista` › **Importar despejo**.
2. Envie `database_backup/casa_barista_producao.sql` (gerado localmente, **não** está no git).

### 2. Código (Plesk › Git)
1. **Git › Adicionar repositório › Repositório remoto**
   - URL: `git@github.com:allepalmeira/casa-barista.git`
     (repositório privado: copie a chave SSH que o Plesk mostra e cadastre no GitHub em
     *Settings › Deploy keys*)
   - Branch: `alle`
   - Caminho do repositório no servidor: `/casa-barista` (**fora** da raiz do site)
   - Modo de implantação: **Manual** (você clica em "Pull" quando quiser atualizar)
2. Clique em **Pull**.

### 3. Dependências e configuração (Plesk › Terminal SSH)
```bash
cd ~/casa-barista/src

composer install --no-dev --optimize-autoloader

cp .env.production.example .env
nano .env                       # preencha DB_PASSWORD (Informação de conexão do banco)
php artisan key:generate

chmod -R 775 storage bootstrap/cache
```

### 4. Publicar em /barista
```bash
ln -s ~/casa-barista/src/public ~/<pasta-raiz-do-site>/barista
```

> **Se o link não funcionar** (página em branco ou 403): apague o link, copie o conteúdo de
> `~/casa-barista/src/public` para `~/<pasta-raiz-do-site>/barista` e, no `index.php` copiado,
> troque `$projeto = __DIR__.'/..';` pelo caminho do projeto (ex.:
> `$projeto = __DIR__.'/../../casa-barista/src';`). Nesse modo, a cada atualização é preciso
> copiar a pasta `public` de novo.

### 5. Otimizar e testar
```bash
cd ~/casa-barista/src
php artisan migrate --force      # não deve rodar nada: o dump já traz as migrations
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
Abra `https://tipi06.smpsistema.com.br/barista` e `.../barista/login`.

### 6. Segurança (logo depois de subir)
- Troque a senha dos usuários de acesso ao admin pelo **Perfil**.
- Os usuários de exemplo 1 a 6 estão com a senha gravada em texto puro e **não conseguem
  entrar**: desative em **Usuários** ou redefina a senha.
- Confira no `.env`: `APP_ENV=production` e `APP_DEBUG=false`.

---

## Atualizar o site depois
1. No computador: commit e push na branch `alle`.
2. Plesk › **Git** › **Pull**.
3. Terminal SSH:
```bash
cd ~/casa-barista/src
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

## Problemas comuns
| Sintoma | Causa provável |
|---|---|
| Erro 500 | `.env` faltando, `APP_KEY` vazio ou senha do banco errada. Veja `storage/logs/laravel.log`. |
| Página do AdminLTE aparece em vez do site | Sobrou um `index.html` na pasta `barista`. Apague. |
| Imagens enviadas pelo admin não aparecem | Permissão da pasta `public/barista/img/...`. |
| Mudou o `.env` e nada aconteceu | Rode `php artisan config:cache` de novo. |
| Links levam para `/` em vez de `/barista` | `APP_URL` sem o `/barista` no final. |
