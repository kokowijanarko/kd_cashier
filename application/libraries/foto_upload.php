<?php
if (!defined('BASEPATH')) exit('No direct script access permitted.');

class Foto_upload
{
  var $CI;  
  
  function resize_crop($config, $resize_width, $resize_height, $tipe, $namafoto)
  {
    if ($config)
    {
      
	  //identitas file asli
	  $im_src = imagecreatefromjpeg('./file/'.$tipe.'/'.$namafoto);
	  $src_width = imageSX($im_src);
	  $src_height = imageSY($im_src);

	  //Simpan dalam versi small 110 pixel
	  //Set ukuran gambar hasil perubahan
	  $dst_width = 270;
	  $dst_height = ($dst_width/$src_width)*$src_height;

	  //proses perubahan ukuran
	  $im = imagecreatetruecolor($dst_width,$dst_height);
	  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
	  
	  // big foto
	  $im2 = imagecreatetruecolor($resize_width,$resize_height);
	  imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $resize_width, $resize_height, $src_width, $src_height);

	  //Simpan gambar
	  imagejpeg($im,"./file/".$tipe."/thumbs/" . $namafoto);
	  imagejpeg($im2,"./file/".$tipe."/" . $namafoto);
	  
	  
	  $dst_width = 100;
	  $dst_height = ($dst_width/$src_width)*$src_height;

	  //proses perubahan ukuran
	  $im = imagecreatetruecolor($dst_width,$dst_height);
	  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	  //Simpan gambar
	  imagejpeg($im,"./file/".$tipe."/small/" . $namafoto);
			  
	  //Hapus gambar di memori komputer
	  imagedestroy($im_src);
	  imagedestroy($im);	  
      		
				
      return $config['new_image'];
    }
    return FALSE;
  }

  function photos($config, $resize_width, $resize_height, $tipe, $namafoto)
  {
    if ($config)
    {
      
	  //identitas file asli
	  $im_src = imagecreatefromjpeg('./file/'.$tipe.'/'.$namafoto);
	  $src_width = imageSX($im_src);
	  $src_height = imageSY($im_src);
	  
	  $dst_width = 100;
	  $dst_height = ($dst_width/$src_width)*$src_height;

	  //proses perubahan ukuran
	  $im = imagecreatetruecolor($dst_width,$dst_height);
	  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	  //Simpan gambar
	  imagejpeg($im,"./file/".$tipe."/thumbs/" . $namafoto);
			  
	  //Hapus gambar di memori komputer
	  imagedestroy($im_src);
	  imagedestroy($im);	  
      		
				
      return $config['new_image'];
    }
    return FALSE;
  }

}

?>