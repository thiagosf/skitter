<?php

/** 
 * ImageResize
 */ 
class ImageResize
{
	protected $file = array();
	protected $info = array();
	protected $config = array();
	protected $name = array();
	
	public function display () {
		if (!isset($_GET['image'])) return;
		
		$image = $_GET['image'];
		$width = (isset($_GET['width'])) ? $_GET['width'] : 800;
		$height = (isset($_GET['height'])) ? $_GET['height'] : 300;
		$quality = (isset($_GET['quality'])) ? $_GET['quality'] : 90;
		$convert = (isset($_GET['convert'])) ? $_GET['convert'] : null;
	
		$options = array(
			'x' => $width,
			'y' => $height,
			'ratio_crop' => true,
			'quality' => $quality,
			'convert' => $convert,
		);
		
		$this->file = $image;
		$this->makeInfo();
		$this->make($options);
	}
	
	/** 
	 * Gera imagem  
	 */
	public function make ($options) {
		if (!$this->isImage()) return;
		
		$this->config = array();
		$this->config['new_width'] = (isset($options['x']) ? $options['x'] : 0);
		$this->config['new_height'] = (isset($options['y']) ? $options['y'] : 0);
		$this->config['width'] = $this->info['width'];
		$this->config['height'] = $this->info['height'];
		$this->config['dst_x'] = 0;
		$this->config['dst_y'] = 0;
		$this->config['src_x'] = 0;
		$this->config['src_y'] = 0;
		$this->config['quality'] = (isset($options['quality']) ? $options['quality'] : 90);
		$this->config['path'] = (isset($options['path']) ? $options['path'] : 'img/');
		$this->config['ext'] = (isset($options['convert']) ? $options['convert'] : $this->info['ext']);
		
		// Imagem original
		$filename = $this->file;
		$imagecreate = 'imagecreatefrom'.($this->info['ext'] == 'jpg' ? 'jpeg' : $this->info['ext']);
		$original = $imagecreate($filename);
		
		if (empty($this->config['new_width']) && $this->config['new_height']) {
			$this->config['new_width'] = ($this->config['new_height'] * $this->config['width']) / $this->config['height'];
		}
		else if (empty($this->config['new_height']) && $this->config['new_width']) {
			$this->config['new_height'] = ($this->config['new_width'] * $this->config['height']) / $this->config['width'];
		}
		else if (empty($this->config['new_width']) && empty($this->config['new_height'])) {
			$this->config['new_width'] = $this->config['width'];
			$this->config['new_height'] = $this->config['height'];
		}
		
		if (isset($options['ratio_crop'])) {
			$ratio_orig = $this->config['width']/$this->config['height'];
			if ($this->config['new_width']/$this->config['new_height'] < $ratio_orig) {
				$this->config['width'] = (($this->config['height'] * $this->config['new_width']) / $this->config['new_height']);
			}
			else {
				$this->config['height'] = (($this->config['width'] * $this->config['new_height']) / $this->config['new_width']);
			}
			$this->config['src_x'] = ($this->info['width'] - $this->config['width']) / 2;
			$this->config['src_y'] = ($this->info['height'] - $this->config['height']) / 2;
		}
		else {
			$ratio_orig = $this->config['width']/$this->config['height'];
			if ($this->config['new_width']/$this->config['new_height'] > $ratio_orig) {
				$this->config['new_width'] = $this->config['new_height']*$ratio_orig;
			}
			else {
				$this->config['new_height'] = $this->config['new_width']/$ratio_orig;
			}
		}
		
		$name_dst = $this->getImageName($options);
		$this->name[] = $name_dst;
		$dst_image = $this->config['path'].$name_dst;
		$image = imagecreatetruecolor($this->config['new_width'], $this->config['new_height']);
		
		imagecopyresampled(
			$image, 
			$original, 
			$this->config['dst_x'], 
			$this->config['dst_y'], 
			$this->config['src_x'], 
			$this->config['src_y'], 
			$this->config['new_width'], 
			$this->config['new_height'], 
			$this->config['width'], 
			$this->config['height']
		);
		
		// Header
		header('Content-type: image/'.$this->config['ext']);
		
		// Tipo da imagem a ser criada
		$imagetype = 'image'.($this->config['ext'] == 'jpg' ? 'jpeg' : $this->config['ext']);
		
		if ($imagetype != 'imagepng') {
			$imagetype($image, null, $this->config['quality']);
		}
		else {
			$imagetype($image);
		}
		
		header('Content-type: image/'.$this->config['ext']);
		imagedestroy($original);
		imagedestroy($image);
	}
	
	/** 
	 * Gera informação da imagem 
	 */
	private function makeInfo () {
		$imagesize = getimagesize($this->file);
		$this->info['width'] = $imagesize[0];
		$this->info['height'] = $imagesize[1];
		$this->info['bits'] = $imagesize['bits'];
		$this->info['channels'] = $imagesize['channels'];
		$this->info['mime'] = $imagesize['mime'];
		$this->info['ext'] = $this->getExtension();
	}
	
	/** 
	 * Resgata extensão da imagem 
	 */
	private function getExtension () {
		if (preg_match('/^.*\.([a-z]{3,4})$/i', $this->file, $matches)) {
			return strtolower($matches[1]);
		}
	}
	
	/** 
	 * Resgata nome da imagem final 
	 */
	private function getImageName ($options) {
		$name = $this->file['name'];
		if (isset($options['name'])) {
			$name = $options['name'].'.'.$this->config['ext'];
		}
		return $name;
	}
	
	/** 
	 * Resgata nomes dos uploads  
	 */
	public function getName () {
		return $this->name;
	}
	
	/** 
	 * Verifica se é imagem o upload 
	 */
	public function isImage () {
		$images = array('jpg', 'jpeg', 'gif', 'png');
		if (in_array($this->info['ext'], $images)) {
			return true;
		}
		return false;
	}
}

$image = new ImageResize();
$image->display();
