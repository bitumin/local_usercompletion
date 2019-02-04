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
 * Library of interface functions and constants for module usercompletion
 *
 * @package    local_usercompletion
 * @copyright  2019 Mitxel Moriana <moriana.mitxel@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Extends the settings navigation with the usercompletion settings
 *
 * @param settings_navigation $navigation
 * @param context $context
 */
function local_usercompletion_extend_settings_navigation(settings_navigation $navigation, context $context) {
    if (!is_siteadmin()) {
        return;
    }

    if ($reportsnode = $navigation->find('reports', navigation_node::TYPE_SETTING)) {
        $url = new moodle_url('/local/usercompletion/index.php');
        $pluginnamestr = get_string('pluginname', 'local_usercompletion');
        $pixicon = new pix_icon('i/report', '');
        $reportsnode->add($pluginnamestr, $url, navigation_node::TYPE_SETTING, null, null, $pixicon);
    }
}
