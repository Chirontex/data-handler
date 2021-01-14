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
use DRNoisier\DataHandler\DictionaryEditor;
use DRNoisier\DataHandler\Exceptions\DictionaryEditorException;

require_once __DIR__.'/autoloader.php';

try {

    switch ($command) {

        case 'set':
            if (empty($key) || empty ($value)) {

                echo 'Key or value not passed.';
                die;

            } else $editor = new DictionaryEditor(__DIR__.'/dictionaries', $filename);

            if ($editor->set($key, $value)) echo 'Value saved to dictionary.';
            else echo 'Value setting to dictionary failed: file not saved.';
            break;

        case 'view':
            if (empty($key)) {

                echo 'Key not passed.';
                die;

            } else $editor = new DictionaryEditor(__DIR__.'/dictionaries', $filename);

            $view_result = $editor->view($key);

            if ($view_result === NULL) echo '(empty)';
            else echo $view_result;
            break;

        case 'help':
            echo 'set — Set new value to dictionary. If dictionary not exist, it will be created.'."\n";
            echo 'view — View dictionary value by the key.';
            break;
        
        default:
            echo 'Invalid command. Use "help" to learn available commands.';
            break;
    }

} catch (DictionaryEditorException $e) {

    echo $e->getMessage();

}
