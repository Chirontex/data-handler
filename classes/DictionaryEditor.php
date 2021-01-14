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

use DRNoisier\DataHandler\Exceptions\DictionaryEditorException;
use DRNoisier\DataHandler\Exceptions\DictionaryHandlerException;

class DictionaryEditor
{

    protected $handler;

    public function __construct(string $path, string $filename)
    {
        
        try {

            $this->handler = new DictionaryHandler($path, $filename);

        } catch (DictionaryHandlerException $e) {

            throw new DictionaryEditorException(
                $e->getMessage(),
                $e->getCode()
            );

        }

    }

    /**
     * Set dictionary value.
     * 
     * @param string|int $key
     * @param mixed $value
     * 
     * @return bool
     * 
     * @throws DictionaryEditorException
     */
    public function set($key, $value) : bool
    {

        try {

            $this->handler->setValue($key, $value);

        } catch (DictionaryHandlerException $e) {

            throw new DictionaryEditorException(
                $e->getMessage(),
                $e->getCode()
            );

        }

        if (isset($e)) return false;
        else return $this->handler->save();

    }

    /**
     * View dictionary value.
     * 
     * @param string|int $key
     * 
     * @return mixed
     * 
     * @throws DictionaryEditorException
     */
    public function view($key)
    {

        try {

            return $this->handler->getValue($key);

        } catch (DictionaryHandlerException $e) {

            throw new DictionaryEditorException(
                $e->getMessage(),
                $e->getCode()
            );

        }

    }

}
