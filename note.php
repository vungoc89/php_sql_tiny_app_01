<?php

/* 

 * 
 * https://ngatngay.net/ma-hoa-bcrypt-trong-php/#:~:text=Trong%20PHP%2C%20mu%E1%BB%91n%20s%E1%BB%AD%20d%E1%BB%A5ng,m%C3%A3%20ho%C3%A1%20Argon2i%20v%C3%A0%20Argon2id.

Trong PHP, muốn sử dụng mã hoá Bcrypt ta sẽ dùng hàm password_hash(). Hàm này thường dùng để mã hoá mật khẩu.

Ngoài mã hoá Bcrypt hàm này còn hỗ trợ mã hoá Argon2i và Argon2id.

password_hash ( string $password , int $algo [, array $options ] ) : string
Trong đó:

$password: chuỗi cần mã hoá
$algo: Phương thức mã hoá (mặc định là Bcrypt). (xem thêm)
$options: mảng tùy chọn (xem thêm)
Kết quả:

Trả về chuỗi mã hoá hoặc FALSE nếu thất bại.

Ví dụ:

<?php

$options = [
    'cost' => 12,
];

echo password_hash("rasmuslerdorf", PASSWORD_BCRYPT, $options);
So sánh 2 chuỗi đã mã hoá?
Đồi khi ta buồn ta chả biết làm gì rồi ngồi vu vơ nghĩ về Bcrypt, khi mà cùng 1 chuỗi nó mã hoá ra nhiều chuỗi mới khác nhau thì làm sao so sánh?

Nhưng không sao, PHP đã cung cấp cho ta 1 hàm giúp làm việc này đó là password_verify().

password_verify ( string $password , string $hash ) : bool
Trong đó:

$password: chuỗi gốc cần so sánh
$hash: chuỗi đã má hoá
Kết quả:

TRUE nếu khớp, FALSE nếu không khớp.

Ví dụ:

<?php

$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

if (password_verify('rasmuslerdorf', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
 * 
 * ---------------------------------------------
 * INSERT INTO `user` (`id`, `username`, `password`, `status`, `create_time`) VALUES (NULL, 'dangngocan', MD5 ('123456'), '0', '111');
 * UPDATE `tbl_users` SET `status` = '1' WHERE `tbl_users`.`id` = 1;
 * ALTER TABLE `tbl_users` ADD UNIQUE(`username`);
 * INSERT INTO `tbl_users` (`id`, `username`, `password`, `status`, `create_time`) VALUES (NULL, 'vuquocngoc', '$2y$10$9D/MmRuoxUL5ruTnostTI.JyQ8zOJd2t4Q2OBYPy9bCLVDgs.wPCi', '0', '123456');
 ----------------RESET PASS Using email---------------------------------------
 * https://www.allphptricks.com/forgot-password-recovery-reset-using-php-and-mysql/
 * http://talkerscode.com/webtricks/password-reset-system-using-php.php
 
 *  ----------------CRUD tieng viet vs popup modal when Delete---------------------------------------
https://www.youtube.com/watch?v=NyZx0B1-iZU (KienThucTin) (xem tai 1:07:16)
 * 
 * ----------------QUAN TRỌNG: ĐỂ HIỂU SELECTION OPTION ONE AND MULTIPLE ---------------------------------------
 * 1.https://codingstatus.com/how-to-insert-select-option-value-in-database-using-php-mysql/
 * 2.https://stackoverflow.com/questions/29446085/how-to-insert-multiple-select-values-into-database
 * https://stackoverflow.com/questions/32470694/php-array-to-string-conversion-in-multiple-selected-dropdown
 * 3.https://www.positronx.io/how-to-get-selected-values-from-select-option-in-php/
 * 
 * 4.Bind array into select option dropdown in php using foreach loop
 * https://www.youtube.com/watch?v=a_PYf-6Ze40
  <?php // foreach ($status as $key => $value) { ?>
                    <!--<option value="<?= //$key ?>"> <?= //$value ?></option>-->

                    <?php // } ?>
 * 
 * 5.Insert Select Option / Dropdown List Value into database in PHP MySQL
 * https://www.youtube.com/watch?v=AHmZ1sKNz64&t=294s
 * 
 * ---------------------- QUAN TRỌNG: SESSION -----------------------
 * https://code.tutsplus.com/tutorials/how-to-use-sessions-and-session-variables-in-php--cms-31839
 
 * ---------------------- QUAN TRỌNG: PHP rest API -----------------------
 * CÓ CÁC SOURCE PROJECT USE PHP + DEMO + DOWNLOAD
 * https://webdamn.com/create-simple-rest-api-with-php-mysql/
 * https://phppot.com/menu/php/restful-api/
 * 
 * ---------------------- QUAN TRỌNG: create table in XAMPP using PHP code  -----------------------
 * https://www.w3schools.com/Php/php_mysql_create_table.asp
 * https://www.tutorialspoint.com/php/create_mysql_database_using_php.htm
 * https://ostechnix.com/create-mysql-database-and-table-using-php-in-xampp/
 * 
 * 
 * ---------------------- QUAN TRỌNG: giai thich su khac nhau giua JOIN vs FOREIGN KEY  -----------------------
 * https://www.programiz.com/sql/foreign-key => TUTORIAL ALL ABOUT SQL
 * 
 * 1.https://stackoverflow.com/questions/40901999/foreign-key-is-needed-for-inner-join-in-sql
 * https://stackoverflow.com/questions/5771190/why-is-a-primary-foreign-key-relation-required-when-we-can-join-without-it
 * https://stackoverflow.com/questions/71823409/how-foreign-key-is-different-from-joins-in-sql
 * https://stackoverflow.com/questions/2947440/foreign-keys-vs-joins
 
 * -----------------import excel file into table database ----------------
 * 1.Cach thu cong: https://www.youtube.com/watch?v=nVhhoGoTNuA
 * 2.1 Cach dung PHP: https://phppot.com/php/import-excel-file-into-mysql-database-using-php/
 * (use https://github.com/PHPOffice/PhpSpreadsheet(A pure PHP library for reading and writing spreadsheet files)
 * 
 * 2.2 https://www.youtube.com/watch?v=9sl6pokAXJk (Import Data From Excel or CSV File to Mysql using PHPSpreadsheet)
 * * * * *  */

