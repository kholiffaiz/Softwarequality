<p align="center"><img src="https://img.17qq.com/images/phmpswwfmny.jpeg" width="400"></p>

## Requirement
Mohon untuk mempersiapkan beberapa Requirement environment untuk menjalankan aplikasi ini:

- [Docker](https://www.docker.com/products/docker-desktop). :white_check_mark:
- [Composer](https://getcomposer.org/download/). :white_check_mark:
- IDE masing-masing (kalo sudah jago bisa pake notepad :muscle:)<br/>=> sublime, atom, vs code, phpstorm dkk (cari di google :computer:)
- Jaringan Internet (kalo gak punya inet bisa hub halo.tiittttttt). :innocent:
- Iman dan taqwa apalagi bulan puasaan gan!! :warning:

## Manjalankan aplikasi

- Pastikan docker telah terinstall terlebih dahulu, untuk mengeceknya bisa melalui terminal pulo gebang :bus:..<br/>
mksdnya buka terminal/cmd ketikkan <b>"docker -v"</b>.. <br/>kalo ada balasan berarti docker sudah berjalan dan terinstall, kalo tidak ada balasan yaa jangan berharap.. :sob: 
- ketikkan <b>"docker-compose up --build -d"</b> (arahkan dulu terminal/cmd ke folder aplikasi laravelnya ya! pakai cd cd itu lho :kissing_smiling_eyes:)
- kemudian ketikkan <b>"composer install"</b> untuk mendownload dependency pihak ketiga keempat dst
- setelah itu ketikkan <b>"cp .env.example .env"</b> untuk melakukan duplikasi/copy file .env
- dan yang terakhir meskipun bukan akhir dari pelatihan ini adalah ketik <b>"php artisan key:generate"</b> untuk generate key laravel<br/>terminal/cmd akan memberikan response "Application key set successfully." dan selamat anda telah lulus! :tada::tada:
- pergi ke browser ketikkan url:<b>localhost</b> dan lihat apa yang terjadi :ok_hand:

## Sponsors

Pelatihan ini disponsori oleh pusdiklat dan pusdatik serta pus pus yang lainnya. :D

## License

The Laravel framework 8 is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

