<?php

namespace phpcms;

	/**
	 * thumbnail short summary.
	 *
	 * thumbnail description.
	 *
	 * @version 1.0
	 * @author vial
	 */
	class thumbnail
	{
        protected $name;  
        protected $address; //����ͼͼ����Դ
        protected $width;
        protected $height;
        protected $boolean = false; //�Ƿ�ɾ��Դ�ļ���Ĭ�ϲ�����
        protected $model = false; //Ĭ��ͬ����

        public function __construct()
        {
            $this->address = \phpcms\conf::get('THUMADDRESS','config');
        }


        /**
         * ����ͨ���������һ�����ö������ֵ
         * @param  string $key  ��Ա������
         * @param  mixed  $val  Ϊ��Ա�������õ�ֵ
         * @return  object     �����Լ�����$this�����������������
         */
        public function set($key, $val){
            if( array_key_exists( $key, get_class_vars(get_class($this)) ) ){//�ж��������Ƿ���ֵ
                $this->$key = $val;
            }
            return $this;
        }


        /**
         * ��������ͼ
         * @return  object   ����ͼƬ��Դ
         */
        public function thumbnail()
        {
            $overWidth = 0; $overHeight = 0;
            $newName = extName('/',$this->name);
            list($setWidth, $setHeight, $setType) = getimagesize($this->name);
            //ƴ�ӷ�������
            $mime=image_type_to_mime_type($setType);
            $imagecreatefrom=str_replace("/", "createfrom", $mime);
            $image=str_replace("/", null, $mime);

            $info = $imagecreatefrom($this->name);//��ȡ��Ϣ

            //�Ѵ�ͼ���Ե�����ͼָ���ķ�Χ�ڣ������ף�ԭͼ��������ţ��ѳ����Ĳ��ֲü�����
            if($this->model){
                if($setWidth/$this->width > $setHeight/$this->height){
                    $this->height = $this->width * ($setHeight/$setWidth);
                }else{
                    $this->width = $this->height * ($setWidth/$setHeight);
                }
                $canvas = imagecreatetruecolor($this->width, $this->height);//׼������
                imagecopyresampled($canvas,$info, 0,0, 0,0, $this->width,$this->height,$setWidth,$setHeight);//����ͼƬ
            }else{//�Ѵ�ͼ���Ե�����ͼָ���ķ�Χ��,���������ף�ԭͼϸ�ڲ���ʧ��
                if($setWidth/$this->width > $setHeight/$this->height){
                    $copyHeight = $this->height;
                    $copyWidth = $copyHeight*($setWidth/$setHeight);
                    $overWidth = ($copyWidth-$this->width)/2;
                }else{
                    $copyWidth = $this->width;
                    $copyHeight = $copyWidth*($setHeight/$setWidth);
                    $overHeight = ($copyHeight-$this->height)/2;
                }
                $canvasCopy = imagecreatetruecolor($copyWidth,$copyHeight);
                // �Ȱ�ͼ���������
                imagecopyresampled($canvasCopy,$info,0,0,0,0,$copyWidth,$copyHeight,$setWidth,$setHeight);
                // �ٽ�ȡ��ָ���Ŀ�߶�
                $canvas = imagecreatetruecolor($this->width,$this->height);
                imagecopyresampled($canvas,$canvasCopy,0,0,0+$overWidth,0+$overHeight,$this->width,$this->height,$copyWidth-$overWidth*2,$copyHeight-$overHeight*2);
            }

            //���ƴ�ӱ����ַ
            $this->address = $this->address.$this->width.'_'.$this->height.'/'.$newName;
            if($this->address && !file_exists(dirname($this->address))){
                mkdir(dirname($this->address),0777,true);
            }

            $image($canvas,$this->address);

            //�ͷ�ͼ��
            //imagedestroy($canvas);
            imagedestroy($info);
            if(!$this->boolean){
                unlink($this->name);
            }
            $this->createImag($canvas);//���ͼ��
            //return $this->address;
        }


        /**
         * ���ͼ��
         * @param mixed $canvas
         */
		private function createImag($canvas) {
			if (imagetypes() & IMG_GIF) {
                header("Content-type: image/gif");
                imagegif($canvas);
			} elseif (function_exists("imagejpeg")) {
                header("Content-type: image/jpeg");
                imagegif($canvas);
			} elseif (imagetypes() & IMG_PNG) {
                header("Content-type: image/png");
                imagegif($canvas);
			}  else {
                die("No image support in this PHP server");
			}
		}


	}
