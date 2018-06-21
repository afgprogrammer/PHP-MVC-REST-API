# php-mvc-simpel-rest-api
simple mvc rest api in php

# آموزش استفاده از این وب سرویس

<p lang="fa" dir="rtl" align="right"> با سلام خدمت دوستان و همشهریان عزیز کشور عزیزم <b> افغانستان </b>
من محمد رحمانی هستم. یک برنامه نویس در حوضه وب. رزومه من رو میتوانید در وب سایت من به نشانی http://mohammadrahmani.com ببینید.</p>

<p lang="fa" dir="rtl" align="right"><b>خب قصد دارم استفاده از این وب سرویس رو در ادامه به شما آموزش بدم اگر سوالی هم داشتید میتونید از طریق وب سایتم با من در ارتباط باشید </b></p>

<h2 lang="fa" dir="rtl" align="right"> وب سرویس (REST API) چیه؟</h2>
<p lang="fa" dir="rtl" align="right">  اونایی که تجربه کار با Api رو دارن خب میدونن چیه ولی اونایی که نمیدونن. </p>
<p lang="fa" dir="rtl" align="right"> اگر از اپلیکیشن های مثلا فیسبوک یا توییتر یا هر اپلیکیشن دیگه ای در گوشیتون استفاده کرده باشید. این اپلیکیشن ها نیاز دارن تا با اینترنت در ارتباط باشن و اطلاعاتی رو از وب سایت مشخصی دریافت و ارسال کنند. </p>

<p lang="fa" dir="rtl" align="right"><b>  به زبون ساده تر میشه گفت وب سرویس زبان ارتباطی بین یک وب سایت و اپلیکیشن هست.</b></p>

<p lang="fa" dir="rtl" align="right">  وارد مسائل پیچیده نمیشیم اگر میخایید کامل یاد بگیرید توی گوگل جستجو کنید. </p>

<h2 lang="fa" dir="rtl" align="right"> اضافه کردن Route جدید</h2>
<p lang="fa" dir="rtl" align="right"> برای این کار فایل Router.php رو از پوشه Router باز کنید </p>
<p lang="fa" dir="rtl" align="right"> مثال هایی از قبل داخل این فایل نوشته شده که میتونید مثل همونا ازش اصتفاده کنید. اما مثال هایی در قالب پارامتر زده نشده که اینجا باهم انجام میدیم </p>

<p lang="fa" dir="rtl" align="right"> اطلاعات اولیه فایل Router.php </p>

```php
<?php

$router->get('/home', 'home@index');

$router->post('/home', 'home@post');

$router->get('/', function() {
    echo 'Welcome ';
});
```

<p lang="fa" dir="rtl" align="right"> برای دریافت پارامتر میتونید این طوری یک روتر بسازید به مثال پایین دقت کنید: </p>

```php
<?php

$router->get('/:name', function($param) {
    echo 'Welcome ' . $param['name'];
});
```
<p lang="fa" dir="rtl" align="right"> و اگر من این آدرس رو وارد کنم. yourdomain.com/mohammad </p>

```
wellcome mohammad
```

<p lang="fa" dir="rtl" align="right"> به همین سادگی. </p>
<p lang="fa" dir="rtl" align="right"> خب شاید بگید که چطور ریکوئست های POST رو هندل کنیم؟ مثال زیرو ببینید:</p>

```php

$router->get('/:name', function($param) {
    echo 'Welcome ' . $param['name'];
});

// فقط کافیه به جای get بنویسید post
$router->post('/:name', function($param) {
    echo 'Welcome ' . $param['name'];
});

```
<h2 lang="fa" dir="rtl" align="right"> ارتباط با دیتابیس</h2>

> <p lang="fa" dir="rtl" align="right">دقت کنید که برای استفاده از دیتابیس شما باید اول فایل config.php رو ویرایش کنید و اطلاعات دیتابیس خودتون رو داخلش وارد کنید</p>

<p lang="fa" dir="rtl" align="right"> حالا میتونید یه فایل مودل در مسیر مشخص خودش بسازید و برای اتصال به دیتابیس و خوندن داده ها از روش زیر استفاده کنید </p>

```php
<?php

use MVC\Model;

class ModelsHome extends Model {

    public function getAllUser() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user");
        
        /*
          $query->row : return 1 row
          $qurty->rows : return all row
          $qurty->num_rows : return row cound
          خب خط اولی فقط یک سطر از دیتابیس خروجی میده... واسه زمانیه که شما فقط اطلاعات یک یوزر رو میخایید
          خط دوم همه سطر هارو برمیگردونه واسه زمانیه که شما همه یوزر هارو خواسته باشد
          و خط سوم هم تعداد سطر های موجود در جدول یوزر رو برمیگردونه
        */
        return $qurty->rows;
    }
}
```
<p lang="fa" dir="rtl" align="right"> خب توضیحات لازم رو توی خود کد نوشتم. </p>

# این فایل باز هم کامل میشه. تا بعد موفق باشد
