# 🐦‍⬛ Hato (鳩) - MVC PHP Mailer API implementation.

## 🦉 How to use?

- first, rename `.env.example` to `.env` and fill data accordingly to your SMTP server setup.

Then you can:
1. deploy as a docker instance on your VPS and connect with frontend form. **or**
2. upload the standalone package to your shared hosting. **or**
3. Extend this package to suit your needs during local development. See [Development requirements](#🥚-development-requirements).

## 🔌 Endpoints

```
GET /api
```

ℹ️ Check if API is running properly.
returns a JSON response with message and status.


```
POST /api/contact
```

ℹ️ Send message via contact from.

Required fields:
- `name`
- `email`
- `message`
- `subject`

returns a JSON response with message, validation informations, and status.

## 🥚 Development requirements

1. Docker [How to install](https://docs.docker.com/desktop/install/mac-install/)
2. Composer [How to install](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos)
3. **Optional**: mkcert [How to install](https://github.com/FiloSottile/mkcert?tab=readme-ov-file#installation)

## 🐣 Setup for development

1. Clone the repository
2. Go to `/docker`. Run `docker compose up -d` to create docker development container.
3. Go to `/app`. Run `composer install` to install all composer dependencies, after that just access your `localhost` as usually.
4. **Optional:** If you want to use local SSL proxy:
- Go to `/certs`. Run `mkcert -install` to install local certificates.
- Run `sudo vi /etc/hosts` and add this line at the end of the file:
```
127.0.0.1 hato.ninja
```
- Run `:wq` to save and quit from vim.
- Run `sudo killall -HUP mDNSResponder` to refresh DNS addresses.
- Enter `https://hato.ninja/api` to the browser. You should see JSON response from API, done! 🥷

## ✅ TODO

- [x] add `Router`
- [x] add routes
- [x] add `MVC`
- [x] add `Statuses`
- [x] add `Controllers`
- [x] add JSON responses
- [x] add form
- [x] add form validation
- [x] add form honeypot
- [x] refactor `MessageController` (_extract validation to the separate Validator class_)
- [x] refactor `MessageController` (_extract mailer setup to the separate Mailer class_)
- [x] add `PHPMailer`
- [x] connect `PHPMailer` with `MessageController`
- [x] use Message model in `MessageController`
- [x] cleanup `MessageController`
- [x] add `.env.example`
- [x] send test e-mail message
- [x] add `Route` model
- [x] use `Route` model inside `routes`
- [x] reduce controllers and adjust controllers naming
- [x] cleanup routes
