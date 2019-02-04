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
 * tool_tenant steps definitions.
 *
 * @package    local_usercompletion
 * @copyright  2019 Mitxel Moriana <moriana.mitxel@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;

require_once(__DIR__ . '/../../../../lib/behat/behat_base.php');

/**
 * Steps definitions for local_usercompletion
 *
 * @package    local_usercompletion
 * @copyright  2019 Mitxel Moriana <moriana.mitxel@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_local_usercompletion extends behat_base {
    /**
     * Completes a course for a given user
     *
     * @Given /^the following course completions exist:$/
     *
     * @param TableNode $data
     */
    public function the_following_course_completions_exist(TableNode $data) {
        global $DB;

        foreach ($data->getHash() as $elementdata) {
            $courseid = $DB->get_record('course', ['shortname' => $elementdata['course']], '*', MUST_EXIST)->id;
            $userid = $DB->get_record('user', ['username' => $elementdata['user']], '*', MUST_EXIST)->id;
            $ccompletion = new completion_completion(['userid' => $userid, 'course' => $courseid]);
            $ccompletion->mark_complete();
        }
    }
}
