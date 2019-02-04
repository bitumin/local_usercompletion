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
 * Class for exporting data.
 *
 * @package    local_usercompletion
 * @copyright  2019 Mitxel Moriana <moriana.mitxel@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_usercompletion\external;

use completion_completion;
use context;
use core\external\exporter;
use renderer_base;

defined('MOODLE_INTERNAL') || die();

/**
 * Class for exporting data.
 *
 * @package    local_usercompletion
 * @copyright  2019 Mitxel Moriana <moriana.mitxel@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class completionreport_view_exporter extends exporter {
    /**
     * Returns a list of objects that are related.
     *
     * @return array
     */
    protected static function define_related(): array {
        return [
            'context' => 'context',
            'userid' => 'int',
        ];
    }

    /**
     * Return the list of additional, generated dynamically from the given properties.
     *
     * @return array
     */
    protected static function define_other_properties(): array {
        return [
            'coursecompletions' => [
                'type' => [
                    'courseid' => [
                        'type' => PARAM_INT,
                    ],
                    'coursefullname' => [
                        'type' => PARAM_TEXT,
                    ],
                    'completionstatus' => [
                        'type' => PARAM_TEXT,
                    ],
                    'timecompleted' => [
                        'type' => PARAM_TEXT,
                    ],
                ],
                'multiple' => true,
                'optional' => true,
            ],
            'coursecompletionscount' => [
                'type' => PARAM_INT,
            ],
        ];
    }

    /**
     * Other values
     *
     * @param renderer_base $output
     * @return array
     */
    protected function get_other_values(renderer_base $output): array {
        /** @var context $context */
        $context = $this->related['context'];
        /** @var int $userid */
        $userid = $this->related['userid'];

        $coursecompletions = [];
        $usercourses = enrol_get_all_users_courses($userid, false, null, 'fullname ASC');

        foreach ($usercourses as $usercourse) {
            $courseid = $usercourse->id;
            $coursefullname = $usercourse->fullname;
            $ccompletion = new completion_completion(['userid' => $userid, 'course' => $courseid]);
            if ($ccompletion->is_complete()) {
                $completionstatus = get_string('completion-y', 'completion');
                $timecompleted = userdate($ccompletion->timecompleted, get_string('strftimedatetime', 'langconfig'));
            } else {
                $completionstatus = get_string('completion-n', 'completion');
                $timecompleted = '';
            }

            $coursecompletions[] = [
                'courseid' => $courseid,
                'coursefullname' => $coursefullname,
                'completionstatus' => $completionstatus,
                'timecompleted' => $timecompleted,
            ];
        }

        return [
            'coursecompletions' => $coursecompletions,
            'coursecompletionscount' => count($coursecompletions),
        ];
    }
}
