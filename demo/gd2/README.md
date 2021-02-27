# Работа с изображениями в PHP
Необходимо подключить расширение php_gd2.dl

## Базовые операции при работе с изображениями

```php
// Создание изображения (256 цветов)
$img = imageCreate(500, 300);

// Создание полноцветного изображения
$img = imageCreateTrueColor(500, 300);

// Генерация изображения в формате GIF

// Копируем на выход
imageGif($img);
 
// Сохраняем на диск
imageGif($img, "logo.gif");
 
// Генерация изображения в формате PNG

// Копируем на выход
imagePng($img);
 
// Сохраняем на диск
imagePng($img, "logo.png");
 
// Генерация изображения в формате JPEG

// Копируем на выход
imageJpeg($img);
imageJpeg($img, null, 75);
 
// Сохраняем на диск
imageJpeg($img, "logo.jpg", 75);
 
// Включение сглаживания
 imageAntiAlias($img, true);
 
// Выбор цвета
$color = imageColorAllocate($img, 255, 0, 0);

// Выбор прозрачного цвета (для формата GIF)
imageColorTransparent($img, $color);

// Заливка фона изображения
imageFill($img, 0, 0, $color);

// Отрисовка пикселя
imageSetPixel($img, 10, 10, $color);

// Отрисовка линии
imageLine($img, 20, 20, 80, 280, $color);

// Отрисовка прямоугольника
imageRectangle($img, 20, 20, 80, 280, $color);

// Отрисовка залитого прямоугольника
imageFilledRectangle($img, 20, 20, 80, 280, $color);

// Отрисовка многоугольника
$points = [0, 0, 100, 200, 300, 200];
imagePolygon($img, $points, 3, $color);

// Отрисовка залитого многоугольника
imageFilledPolygon($img, $points, 3, $color);

// Отрисовка эллипса
imageEllipse($img, 200, 150, 300, 200, $color);

// Отрисовка залитого эллипса
imageFilledEllipse($img, 200, 150, 300, 200, $color);

// Отрисовка дуги
imageArc($img, 200, 150, 300, 200, 0, 40, $color);

// Отрисовка сектора
imageFilledArc($img, 200, 150, 300, 200, 0, 40, $color, IMG_ARC_PIE);
imageFilledArc($img, 200, 150, 300, 200, 0, 40, $color, IMG_ARC_CHORD);
imageFilledArc($img, 200, 150, 300, 200, 0, 40, $color, IMG_ARC_EDGED | IMG_ARC_NOFILL);
 
// Отрисовка текста
imageString($img, 3, 150, 200, "Текст", $color);

// Отрисовка первого символа текста
imageChar($img, 3, 150, 200, "Текст", $color);

// Отрисовка первого символа текста лежащего на левом боку
imageCharUp($img, 3, 150, 200, "Текст", $color);

// Продвинутая отрисовка текста
imageTtfText($img, 30, 10, 300, 150, $color, "Arial.ttf", "Текст");

// Использование существующего изображения
$img = imageCreateFromGif("picture.gif");
$img = imageCreateFromPng("picture.png");
$img = imageCreateFromJpeg("picture.jpg");
$img = imageCreateFromString($string);

// Установка толщины линии
imageSetThickness($img, 5);

// Использование стилей
$style = [$red, $red, $red, $black, $black, $black];
imageSetStyle($img, $style);
imageLine($img, 20, 20, 80, 280, IMG_COLOR_STYLED);
```

