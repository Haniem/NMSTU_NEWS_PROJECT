##Роуты и создание контроллеров для них##


1. Создать файл контроллера в папке апи с подпапкой с названием дейсвтия контроллера:
*Пример:*
*php artisan make:controller /Api/User/UserController*

2. Подключить файл с контроллеров в routes/api.php в строках Use(там есть примеры, разберетесь)
3. В самом контроллере создаете функцию с нужным названием указанным в роуте (..class, '*Название функции*')
4. Пишите код выполняюший действия описанные в коментариях к коду к роутам

Гайды: 
    1. Работа с роутами - https://www.youtube.com/watch?v=a41HF8e2Tbc
    2. Работа с токеном(У кого в коментарии к коду указано что работаем только с токеном). Индус дословно объясняет - https://www.youtube.com/watch?v=Wtsl-gtRUko
    3. Получение данных из базы данных - https://www.youtube.com/watch?v=Ey97HMI6yV8
    4. И вообще целый плейлист с работой с апи(Скорее всего тут есть вся инфа, которая вам понадобится) - https://www.youtube.com/watch?v=jCZj3SYGCJ8&list=PLze7bMjv1CYv7JNFtFjs1jqE5bW5WHQDP

Ваши задачи:

                            МАКСИМУС
Route::get('/profile',[UserController::class, 'getProfileData'])->middleware('auth:sanctum'); //Выдача инфомрации о пользователе (только с токеном)
Route::get('/profile/userPosts',[UserController::class, 'getUserPosts'])->middleware('auth:sanctum'); //Выдача постов пользователяи (только с токеном)


                            ПАШКУС
Route::get('/profile/userLikedPosts',[UserController::class, 'getUserPosts'])->middleware('auth:sanctum'); //Выдача пролайканных постов (только с токеном)

                            ВЕРОНИКА
Route::post('/profile/edit',[UserController::class, 'updateUserData'])->middleware('auth:sanctum'); // Запись отредактированных данных (только с токеном)

                            САШКУС
Route::get('/posts', [PostController::class, 'getPosts']); // Получить все посты
Route::post('/posts/create', [PostController::class, 'createPost'])->middleware('auth:sanctum'); // Запись данных посте (только с токеном)

                            ЯНЧИК
Route::post('/posts/{id}', [PostController::class, 'getPostData']); //Получить данные конкретного поста
Route::get('types', [TypeController::class, 'getTypes']); //Получить себе все разделы

                            ЕГОРИК
Route::get('/comments', [ComentController::class, 'getPosts']); // Получить все коментарии
Route::post('/comments/create', [ComentController::class, 'createPosts']); // Создать коментарий

                            БОГДАНЧИК
Route::get('/likes', [LikeController::class, 'getPostLikes']); // Получить все лайки на посте
Route::get('/likes/add', [LikeController::class, 'addPostLikes'])->middleware('auth:sanctum'); // Поставить лайк (только с токеном)

