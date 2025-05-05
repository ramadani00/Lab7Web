<img src="https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExbmhmaTQzeTkyM2thcjd1Mnlwa2d5eWp5cTU3Nnk4ZGpnc2RocTdnZiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/lM2TNaYAer3NN4d6eF/giphy.gif"  style="width: 500px; height: auto;" alt="Description"/>

### Dini Ramadani | Universitas Pelita Bangsa

<h1 style="color: blue; font-size: 36px; text-align: center;">Praktikum 4 | Framework Lanjutan (Modul Login)</h1>
<br>

<div class="navbar">
  <h2>📚 Daftar Isi</h2>
  <ul class="toc-list">
    <li><a href="#persiapan">📌 Persiapan</a></li>
    <li><a href="#membuat-model-user">🛠️ Membuat Model User</a></li>
    <li><a href="#membuat-controller-user">🧑‍💻 Membuat Controller User</a></li>
    <li><a href="#membuat-view-login">🎨 Membuat View Login</a></li>
    <li><a href="#membuat-database-seeder">💾 Membuat Database Seeder</a></li>
    <li><a href="#uji-coba-login">🧪 Uji Coba Login</a></li>
    <li><a href="#menambahkan-auth-filter">🔒 Menambahkan Auth Filter</a></li>
    <li><a href="#percobaan-akses-menu-admin">📂 Percobaan Akses Menu Admin</a></li>
    <li><a href="#fungsi-logout">🚪 Fungsi Logout</a></li>
  </ul>
</div>

<br>

## Langkah-langkah Praktikum

## Persiapan
- Pastikan **MySQL Server** berjalan melalui **XAMPP**.
- Buat database dan tabel `user` dengan struktur berikut:

```sql
CREATE TABLE user (
    id INT(11) AUTO_INCREMENT,
    username VARCHAR(200) NOT NULL,
    useremail VARCHAR(200),
    userpassword VARCHAR(200),
    PRIMARY KEY (id)
);
```

![img2](assets/img/table_user.png)
<br>

<br>

## Membuat Model User
Selanjutnya adalah membuat Model untuk memproses data Login. Buat file baru pada direktori ``app/Models`` dengan nama ``UserModel.php``

```php
<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['username', 'useremail', 'userpassword'];
}
```
![img3](assets/img/usermodel.png)
<br>

<br>

## Membuat Controller User
Buat Controller baru dengan nama ``User.php`` pada direktori ``app Controllers``. Kemudian tambahkan method ``index()`` untuk menampilkan daftar user, dan method ``login()`` untuk proses login.

```php
<?php
namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function index() 
    {
        $title = 'Daftar User';
        $model = new UserModel();
        $users = $model->findAll();
        return view('user/index', compact('users', 'title'));
    }

    public function login()
    {
        helper(['form']);
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if (!$email) {
            return view('user/login');
        }

        $session = session();
        $model = new UserModel();
        $login = $model->where('useremail', $email)->first();

        if ($login) {
            $pass = $login['userpassword'];
            if (password_verify($password, $pass)) {
                $login_data = [
                    'user_id' => $login['id'],
                    'user_name' => $login['username'],
                    'user_email' => $login['useremail'],
                    'logged_in' => TRUE,
                ];
                $session->set($login_data);
                return redirect('admin/artikel');
            } else {
                $session->setFlashdata("flash_msg", "Password salah.");
                return redirect()->to('/user/login');
            }
        } else {
            $session->setFlashdata("flash_msg", "Email tidak terdaftar.");
            return redirect()->to('/user/login');
        }
    }
}
```

![img4](assets/img/cu1.png)
<br>

![img5](assets/img/cu2.png)
<br>

<br>

## Membuat View Login
Buat direktori baru dengan nama ``user`` pada direktori ``app/views``, kemudian buat file baru dengan nama ``login.php``. 

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
</head>
<body>
    <div id="login-wrapper">
        <h1>Sign In</h1>
        <?php if (session()->getFlashdata('flash_msg')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('flash_msg') ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="InputForEmail" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="InputForEmail" value="<?= set_value('email') ?>">
            </div>
            <div class="mb-3">
                <label for="InputForPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="InputForPassword">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
```

![img6](assets/img/viewlogin.png)
<br>

<br>

## Membuat Database Seeder
Database seeder digunakan untuk membuat data dummy. Untuk keperluan ujicoba modul login, kita perlu memasukkan data user dan password kedaalam database. Untuk itu buat database seeder untuk tabel user. Buka CLI, kemudian tulis perintah berikut:

```bash
php spark make:seeder UserSeeder
```

![img7](assets/img/dbseeder.png)
<br>

<br>

Selanjutnya, buka file ``UserSeeder.php`` yang berada di lokasi direktori ``/app/Database/Seeds/UserSeeder.php`` kemudian isi dengan kode berikut:

```php
<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $model = model('UserModel');
        $model->insert([
            'username' => 'admin',
            'useremail' => 'admin@email.com',
            'userpassword' => password_hash('admin123', PASSWORD_DEFAULT),
        ]);
    }
}
```

![img8](assets/img/seederphp.png)
<br>

<br>

Selanjutnya buka kembali CLI dan ketik perintah berikut:
```bash
php spark db:seed UserSeeder
```

![img9](assets/img/userseeder.png)
<br>


<br>

## Uji Coba Login
Selanjutnya buka url http://localhost:8080/user/login seperti berikut:

![img10](assets/img/login.png)
<br>

<br>

## Menambahkan Auth Filter
Selanjutnya membuat filer untuk halaman admin. Buat file baru dengan nama ``Auth.php`` pada direktori ``app/Filters``.

```php
<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/user/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
```

![img11](assets/img/authfilterphp.png)
<br>

<br>

Selanjutnya buka file ``app/Config/Filters.php`` tambahkan kode berikut:
```php
'auth' => App\Filters\Auth::class

```
<br>

![img12](assets/img/auth.png)
<br>

Selanjutnya buka file ``app/Config/routes.php`` dan sesuaikan kodenya.

![img13](assets/img/routes.png)
<br>

<br>

## Percobaan Akses Menu Admin
Buka url dengan alamat http://localhost:8080/admin/artikel ketika alamat tersebut diakses maka, akan dimuculkan halaman login.

<br>

![img14](assets/img/login.png)

<br>

## Fungsi Logout
Tambahkan method logout pada Controller User seperti berikut:
```php
public function logout() 
 {
    session()->destroy();
 return redirect()->to('/user/login');
 }

```
![img15](assets/img/logout.png)

<br>

<br>


<br>

  <div class="centered">
    <img src="https://media.giphy.com/media/XLx9jXZXzm8Sv415Tf/giphy.gif?cid=ecf05e47hk6i4tunpqmceczwxjzujix9sxxpbjv2f4woa33v&ep=v1_stickers_search&rid=giphy.gif&ct=s" 
         style="width: 400px; height: auto;" 
         alt="Description"/>
  </div>