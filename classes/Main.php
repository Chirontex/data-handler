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

use DRNoisier\DataHandler\Exceptions\MainException;
use DRNoisier\DataHandler\Exceptions\SpreadsheetHandlerException;
use PhpOffice\PhpSpreadsheet\IOFactory;

final class Main
{

    protected $handler;

    public function __construct(string $pathfile)
    {
        
        $pathfile_explode = explode('.', $pathfile);

        if ($pathfile_explode[1] !== 'xls' &&
            $pathfile_explode[1] !== 'xlsx') throw new MainException(
                'Invalid file extension.',
                -10
            );

        try {

            $this->handler = new SpreadsheetHandler(IOFactory::load($pathfile));

        } catch (SpreadsheetHandlerException $e) {

            throw new MainException(
                $e->getMessage(),
                $e->getCode()
            );

        }

    }

}
