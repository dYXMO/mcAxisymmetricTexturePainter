<?php

// 创建 4x4 的画布
$image = imagecreatetruecolor(4, 4);

// 循环解析传入的所有颜色参数
for ($i = 1; $i <= 4; $i++) {
  for ($j = 0; $j < 4; $j++) {
    // 获取传入的颜色值
    $color = $_GET['L' . $i . '_' . $j];
    // 将颜色值转化为数组
    $color = explode(',', str_replace(array('rgb(', ')'), '', $color));
    // 将 RGB 颜色转化为十六进制
    $color = imagecolorallocate($image, $color[0], $color[1], $color[2]);
    // 在画布上绘制该颜色的像素
    imagesetpixel($image, $j, $i - 1, $color);
  }
}
//////////////////////////

// 创建一个新的 8x8 的图像
$new_image = imagecreatetruecolor(8, 8);

// 将 $image 缩小为 4x4 并复制到 $new_image 的左上角
imagecopyresized($new_image, $image, 0, 0, 0, 0, 4, 4, 4, 4);

// 复制 $new_image 的右上角到 $new_image 的右下角
imagecopymerge($new_image, $new_image, 4, 4, 0, 0, 4, 4, 100);

//右上角
$image = imagerotate($image, -90, 0);
imagecopy($new_image, $image, 4, 0, 0, 0, 4, 4);

// 复制 $new_image 的右下角到 $new_image 的左下角
$image = imagerotate($image, 180, 0);
imagecopy($new_image, $image, 0, 4, 0, 0, 4, 4);

// 复制 $new_image 的左下角到 $new_image 的左上角
imagecopymerge($new_image, $new_image, 0, 0, 4, 4, 4, 4, 100);

//右下
$image = imagerotate($image, 90, 0);
imagecopy($new_image, $image, 4, 4, 0, 0, 4, 4);
// 输出图像
header('Content-Type: image/png');
imagepng($new_image);

// 释放图像资源
imagedestroy($new_image);


