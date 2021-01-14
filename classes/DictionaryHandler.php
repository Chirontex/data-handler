<?php
/**
 *    Data Handler
 *    Copyright (C) 2020  Dmitry Shumilin (dr.noisier@yandex.ru)
 *
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */
namespace DRNoisier\DataHandler;

use DRNoisier\DataHandler\Exceptions\DictionaryHandlerException;

class DictionaryHandler
{

    protected $path;
    protected $filename;
    protected $dictionary;

    public function __construct(string $path, string $filename)
    {
        
        if (empty($path)) throw new DictionaryHandlerException(
            'Path cannot be empty.',
            -30
        );

        if (empty($filename)) throw new DictionaryHandlerException(
            'Filename cannot be empty.',
            -31
        );

        if (!file_exists($path)) {

            if (!mkdir($path)) throw new DictionaryHandlerException(
                'Directory creation failure.',
                -32
            );

        }

        $this->path = $path;

        $filename_exploded = explode('.', $filename);

        if ($filename_exploded[count($filename_exploded) - 1] !==
            'json') $filename .= '.json';

        $this->filename = $filename;

        if (file_exists(
            $this->path.$this->filename
        )) $this->dictionary = json_decode(
                file_get_contents($this->path.$this->filename),
                true
        );
        else $this->dictionary = [];

        if (!is_array($this->dictionary)) throw new DictionaryHandlerException(
            'Invalid dictionary data format.',
            -33
        );

    }

    /**
     * Return all dictionary data.
     * 
     * @return array
     */
    public function getAllDictionary() : array
    {

        return $this->dictionary;

    }

    /**
     * Return dictionary value by the key.
     * 
     * @param string|int $key
     * 
     * @return mixed
     * 
     * @throws DictionaryHandlerException
     */
    public function getValue($key)
    {

        if (!is_string($key) && !is_int($key)) throw new DictionaryHandlerException(
            'Invalid key data type.',
            -34
        );

        return $this->dictionary[$key];

    }

    /**
     * Set or add dictionary value by the key.
     * 
     * @param string|int $key
     * @param mixed $value
     * 
     * @return void
     * 
     * @throws DictionaryHandlerException
     */
    public function setValue($key, $value) : void
    {

        if (!is_string($key) && !is_int($key)) throw new DictionaryHandlerException(
            'Invalid key data type.',
            -34
        );

        $this->dictionary[$key] = $value;

    }

    /**
     * Save dictionary to file.
     * 
     * @return bool
     */
    public function save() : bool
    {

        if (file_put_contents(
            $this->path.$this->filename,
            $this->dictionary
        ) === false) return false;
        else return true;

    }

}
