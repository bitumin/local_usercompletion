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
 * File for class completionreport_view
 *
 * @package    local_usercompletion
 * @copyright  2019 Mitxel Moriana <moriana.mitxel@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_usercompletion\output;

defined('MOODLE_INTERNAL') || die();

use context;
use local_usercompletion\external\completionreport_view_exporter;
use renderable;
use renderer_base;
use stdClass;
use templatable;

/**
 * Class completionreport_view
 *
 * @package    local_usercompletion
 * @copyright  2019 Mitxel Moriana <moriana.mitxel@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class completionreport_view implements templatable, renderable {
    /**
     * @var context $context
     */
    protected $context;
    /**
     * @var int $userid
     */
    protected $userid;

    /**
     * edit_program_view constructor.
     *
     * @param context $context
     * @param int $userid
     */
    public function __construct(context $context, int $userid) {
        $this->context = $context;
        $this->userid = $userid;
    }
    /**
     * Implementation of exporter from templatable interface
     *
     * @param renderer_base $output
     * @return stdClass
     */
    public function export_for_template(renderer_base $output): stdClass {
        $exporter = new completionreport_view_exporter(null, ['context' => $this->context, 'userid' => $this->userid]);
        return $exporter->export($output);
    }
}
