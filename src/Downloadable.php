<?php

namespace Diskominfotik\Downloadable;

use Rap2hpoutre\FastExcel\FastExcel;

class Downloadable
{
    /**
     * Dot helper for extension
     */
    const DOT_EXTENSION = '.';

    /**
     * Store data collection
     *
     * @var Array|Collections
     */
    protected $data;

    /**
     * Store filename
     *
     * @var String
     */
    protected $filename;

    /**
     * Store file extension
     *
     * @var String
     */
    protected $extension;

    /**
     * Set filetype
     *
     * @param string $filetype
     * @return \Diskominfotik\Downloadable\Downloadable
     */
    public function as($filetype)
    {
        $allowedFile = [
            'spreadsheet' => 'xlsx',
            'csv' => 'csv',
            'pdf' => 'pdf'
        ];
        $availableExt = array_keys($allowedFile);
        if (in_array($filetype, $availableExt)) {
            $this->extension = $allowedFile[$filetype];
            return $this;
        }
        throw new \Exception('Unsupported file');
    }

    /**
     * Get File extension
     *
     * @return string
     */
    public function getExtension($withDot = true)
    {
        return !$withDot ? $this->extension : self::DOT_EXTENSION . $this->extension;
    }

    /**
     * Set data to download
     *
     * @param Array|Collections $data
     * @return \Diskominfotik\Downloadable\Downloadable
     */
    public function withData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Get data
     *
     * @return Array|Collections
     */
    public function getData()
    {
        if ($this->data) {
            return $this->data;
        }
        throw new \Exception('Data has never been set');
    }

    /**
     * Set Filename
     *
     * @param String $filename
     * @return \Diskominfotik\Downloadable\Downloadable
     */
    public function withFilename($filename)
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * Get Filename
     *
     * @return String
     */
    public function getFilename()
    {
        if ($this->filename) {
            return $this->filename;
        }
        $basicName = date("YmdHis");
        return sha1($basicName);
    }

    /**
     * Force Download
     *
     * @param callable $callback
     * @return void
     */
    public function get(callable $callback = null)
    {
        $data = $this->getData();
        $ext = $this->getExtension();
        $filename = $this->getFilename() . $ext;
        switch ($ext) {
            case '.xlsx':
                return $this->toSpredsheet($data, $filename, $callback);
                break;
            default:
                throw new \Exception('Unsupported file');
                break;
        }
    }

    /**
     * Convert data to Spreadsheet
     *
     * @param Array $data
     * @param String $filename
     * @param callable $callback
     * @return void
     */
    protected function toSpredsheet($data, $filename, callable $callback = null)
    {
        $generator = function ($data, callable $callback = null) {
            foreach ($data as $value) {
                yield $callback
                    ? $callback($value)
                    : $value;
            }
        };
        return (new FastExcel($generator($data, $callback)))->download($filename);
    }
}
