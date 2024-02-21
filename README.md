<a name="readme-top"></a>

<!-- PROJECT LOGO -->
<br />
<div align="center">
    <img src="public/logo.svg" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">IOGM</h3>

</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#feature">Feature</a></li>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->

## About The Project

Isi dari project ini adalah aplikasi chat sederhana.

Demo app : https://staging.chat.iogm.website

### Feature


<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Built With

<table style="border-collapse: collapse;">
    <tr>
        <td style="border: none;">
            <div style="display: flex; align-items:center; gap: 15px;">
                <img src="https://laravel.com/img/logomark.min.svg" height=35>
            </div>
        </td>
        <td style="border: none;">
            <img src="https://www.vectorlogo.zone/logos/mysql/mysql-ar21.png" height=35>
        </td>
        <td style="border: none;">
            <img src="https://pusher.com/static/pusher-logo-0576fd4af5c38706f96f632235f3124a.svg" style='background-color: white; padding:5px; box-sizing:border-box' height=35>
        </td>
    </tr>
</table>

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- GETTING STARTED -->

## Getting Started

_Berikut ini adalah cara untuk memulai pengetesan._

1. Clone
   ```sh
   git clone https://github.com/iogm-git/app-chat.git
   ```
2. Update composer
   ```sh
   composer update
   ```
3. Copy .env.example and setting env
    ---
        APP_URL=http://localhost:8000 # setting jika di production (menyesuaikan cors)

        DB_CONNECTION=mysql
        DB_HOST=your_db_host
        DB_PORT=your_db_port
        DB_DATABASE=your_db
        DB_USERNAME=your_db_username
        DB_PASSWORD=your_db_password

        BROADCAST_DRIVER=pusher

        # setting agar fitur kirim email verifikasi berjalan
        # buka console google
        MAIL_MAILER=mysql
        MAIL_HOST=smtp.gmail.com
        MAIL_PORT=587
        MAIL_USERNAME=your_email
        MAIL_PASSWORD=your_app_password_in_email
        MAIL_ENCRYPTION=tls
        MAIL_FROM_ADDRESS=your_email
        MAIL_FROM_NAME="${APP_NAME}"

        # daftar pusher dan sesuaikan key
        PUSHER_APP_ID=your_pusher_id
        PUSHER_APP_KEY=your_pusher_key
        PUSHER_APP_SECRET=your_pusher_secret
        PUSHER_HOST=
        PUSHER_PORT=443
        PUSHER_SCHEME=https
        PUSHER_APP_CLUSTER=your_pusher_cluster

    ---
4. Generate Key
   ```sh
   php artisan key:generate
   ```

5. Jalankan migrate and seed
   ```sh
   php artisan migrate:fresh --seed
   ```
<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- USAGE EXAMPLES -->
## Usage

Untuk mencoba aplikasi dapat login menggunakan email dan password, terdapat 3 user : 
- User 1 :
  - email : user1@gmail.com
  - password : user1@gmail.com
- User 2 :
  - email : user2@gmail.com
  - password : user2@gmail.com
- User 3 :
  - email : user3@gmail.com
  - password : user3@gmail.com

Atau jika ingin register jangan lupa untuk memverifikasi email kemudian
<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- CONTACT -->

## Contact

Ilham Rahmat Akbar - ilhamrhmtkbr@gmail.com

<p align="right">(<a href="#readme-top">back to top</a>)</p>

