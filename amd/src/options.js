// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * YuJa Plugin for Moodle Tiny
 * @module     tiny_yuja/options
 * @copyright  2023 YuJa
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import {getPluginOptionName} from 'editor_tiny/options';
import {pluginName} from './common';

const paramUrlsName = getPluginOptionName(pluginName,'paramUrls');

/**
 * Options registration function.
 *
 * @param {tinyMCE} editor
 */
export const register = (editor) => {
    const registerOption = editor.options.register;

    // For each option, register it with the editor.
    // Valid type are defined in https://www.tiny.cloud/docs/tinymce/6/apis/tinymce.editoroptions/
    registerOption(paramUrlsName, {
        processor: 'object',
    });
};

/**
 * Fetch the paramUrls value for this editor instance.
 *
 * @param {tinyMCE} editor The editor instance to fetch the value for
 * @returns {object} The value of the paramUrls option
 */
export const getParamUrls = (editor) => editor.options.get(paramUrlsName);