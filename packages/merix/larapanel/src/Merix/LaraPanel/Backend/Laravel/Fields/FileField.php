<?php

namespace Merix\LaraPanel\Backend\Laravel\Fields;


use Merix\LaraPanel\Backend\Laravel\Utils\Convert;
use Merix\LaraPanel\Backend\Laravel\Utils\Utils;
use Merix\LaraPanel\Core\Contracts\Components\DownloadableField;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FileField extends TextField implements DownloadableField
{
    protected $basePath;


    protected function getDefaultParameters()
    {
        return array_merge(parent::getDefaultParameters(), [
            'basePath' => storage_path('larapanel/files/'),
        ]);
    }

    protected function init()
    {
        parent::init();

        $this->basePath = $this->getConfigValue('basePath');

    }

    public function getType()
    {
        return 'file';
    }

    protected function getBasePath()
    {
        return $this->basePath;
    }


    public function getDownload($type)
    {
        try
        {
            $data = $this->serialize($this->get());

            if($data == null || !isset($data['internal']))
            {
                throw new NotFoundHttpException();
            }

            return response()->file($this->getBasePath() . $data['internal']);
        }
        catch (FileNotFoundException $ex)
        {
            throw new NotFoundHttpException('', $ex);
        }
    }


    public function serialize($data)
    {
        // Data:
        // file-name|original-name|file-size
        // eg.
        // adef13fa|picture.jpg|1700

        $data = explode('|',$data);

        return [
            'name'      => $this->getName(),
            'value'     => $data[1],    //File name
            'size'      => $data[2],
            'internal'  => $data[0],
        ];
    }

    public function deserialize($data)
    {
        if(!isset($data['value']))
            return null;

        if(isset($data['base64']))
        {
            // Create a new file
            $result = $this->createFile($data['base64'], $data['value']);

            if($result === null)
                return null;

            return implode('|', $result);
        }

        if(isset($data['internal']) && isset($data['size']))
        {
            return $data['internal'] . '|' . $data['value'] . '|' . $data['size'];
        }

        // We don't know anything, so lets just deserialize existing data and use it
        $oldData = $this->serialize($this->get());

        return $oldData['internal'] . '|' . $data['value'] . '|' . $oldData['size'];
    }

    protected function createFile($base64, $fileName)
    {
        $func = $this->getConfig()->getClosure('namegen');

        if($func != null)
        {
            $name = $func($this, $fileName);
        }
        else
        {
            $name = Utils::getUniqueFileName($this->getBasePath(), $fileName);
        }

        $data = base64_decode($base64);

        if($data === false)
            return null;

        $size = file_put_contents($this->getBasePath() . $name, $data);

        if($size !== false){
            return [
                'internal' => $name,
                'value' => $fileName,
                'size' => Convert::fileSizeToHumanReadable($size),
            ];
        }

        return null;

    }

}