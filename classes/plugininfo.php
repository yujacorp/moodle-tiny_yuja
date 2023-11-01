<?php
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
 * @package    tiny_yuja
 * @subpackage yuja
 * @copyright  2023 YuJa
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


namespace tiny_yuja;
global $CFG;
require_once($_SERVER['DOCUMENT_ROOT']. '/local/yuja/classes/local_yuja/yuja_client.class.php');

use context;
use editor_tiny\plugin;
use editor_tiny\plugin_with_buttons;
use editor_tiny\plugin_with_menuitems;
use editor_tiny\plugin_with_configuration;
use editor_tiny\editor;

class plugininfo extends plugin implements plugin_with_configuration, plugin_with_buttons, plugin_with_menuitems {

    public static function get_available_buttons(): array {
        return [
            'tiny_yuja/plugin',
        ];
    }

    public static function get_available_menuitems(): array {
        return [
            'tiny_yuja/plugin',
        ];
    }

    public static function get_yuja_client(){
        $params = array (
            "yujaVideosUrl",
            "yujaJsUrl",
            "yujaError"
        );
        $yujaclient = new \yuja_client();
        $params = $params + $yujaclient->get_texteditor_params();
        $jsonstring = json_encode(array('yujaVideosUrl'=>$params['yujaVideosUrl'], 'yujaJsUrl'=> $params['yujaJsUrl'], 'yujaError' => $params['yujaError']));
        echo \html_writer::tag('input', '', array('id' => 'urldata', 'type' => 'hidden', 'value' => $jsonstring));
        return $params;
    }

    public static function get_plugin_configuration_for_context(
        context $context,
        array $options,
        array $fpoptions,
        ?\editor_tiny\editor $editor = null
    ): array {
        return [
            // Your values go here.
            // These will be mapped to a namespaced EditorOption in Tiny.
            'paramUrls' =>self::get_yuja_client(),
        ];
    }
    
}