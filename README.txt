


W przypadku pojawienia się błędu: 
[Illuminate\Database\QueryException]
SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes (SQL: alter table users add unique users_email_unique(email))

należy postąpić jak to zostało opisane w artykule: 
https://laravel-news.com/laravel-5-4-key-too-long-error