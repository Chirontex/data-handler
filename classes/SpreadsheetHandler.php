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

use DRNoisier\DataHandler\Exceptions\SpreadsheetHandlerException;

class SpreadsheetHandler
{

    protected $spreadsheet;

    public function __construct(object $spreadsheet)
    {
        
        if (get_class($spreadsheet) ===
            'PhpOffice\\PhpSpreadsheet\\Spreadsheet') $this->spreadsheet = $spreadsheet;
        else throw new SpreadsheetHandlerException(
            'Invalid spreadsheet class.',
            -20
        );

    }

}
