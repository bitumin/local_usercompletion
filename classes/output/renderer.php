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
 * Renderer for local_usercompletion
 *
 * @package    local_usercompletion
 * @copyright  2019 Mitxel Moriana <moriana.mitxel@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_usercompletion\output;

use plugin_renderer_base;

defined('MOODLE_INTERNAL') || die();

/**
 * Class renderer
 *
 * @package    local_usercompletion
 * @copyright  2019 Mitxel Moriana <moriana.mitxel@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {
    /**
     * Renders user list view
     *
     * @param userlist_view $renderable
     * @return string HTML
     */
    public function render_userlist_view(userlist_view $renderable): string {
        $context = $renderable->export_for_template($this);
        return $this->render_from_template('local_usercompletion/userlist_view', $context);
    }

    /**
     * Renders completion report view
     *
     * @param completionreport_view $renderable
     * @return string HTML
     */
    public function render_completionreport_view(completionreport_view $renderable): string {
        $context = $renderable->export_for_template($this);
        return $this->render_from_template('local_usercompletion/completionreport_view', $context);
    }
}
