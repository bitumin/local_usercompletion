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
 * Class userlist_table
 *
 * @package    local_usercompletion
 * @copyright  2019 Mitxel Moriana <moriana.mitxel@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_usercompletion\output;

use coding_exception;
use context;
use context_system;
use html_writer;
use moodle_url;
use stdClass;
use table_sql;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/tablelib.php');

/**
 * Class userlist_table for displaying user list table
 *
 * @package    local_usercompletion
 * @copyright  2019 Mitxel Moriana <moriana.mitxel@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class userlist_table extends table_sql {
    /** @var context */
    protected $context;

    /**
     * Sets up the userlist_table parameters.
     *
     * @param string $uniqueid unique id of form.
     * @throws coding_exception
     */
    public function __construct($uniqueid) {
        global $PAGE;
        parent::__construct($uniqueid);
        $this->set_attribute('id', 'userlist_table');
        $columns = [
            'name',
            'email',
            'actions',
        ];
        $headers = [
            get_string('fullname'),
            get_string('email'),
            get_string('actions'),
        ];
        $this->context = context_system::instance();

        $this->define_columns($columns);
        $this->define_headers($headers);
        $this->pageable(true);
        $this->collapsible(false);
        $this->sortable(false);
        $this->is_downloadable(false);
        $this->define_baseurl($PAGE->url);
        $fields = 'id,username,email,firstnamephonetic,lastnamephonetic,middlename,alternatename,firstname,lastname';
        $this->set_sql($fields, '{user}', '1=1');
    }

    /**
     * Displays column name
     *
     * @param stdClass $row
     * @return string
     */
    protected function col_name($row): string {
        return format_string(fullname($row));
    }

    /**
     * Displays column email
     *
     * @param stdClass $row
     * @return string
     */
    protected function col_email($row): string {
        return format_string($row->email);
    }

    /**
     * Displays column actions.
     *
     * @param stdClass $row
     * @return string
     */
    protected function col_actions(stdClass $row): string {
        global $OUTPUT;

        $reporticon = $OUTPUT->pix_icon('i/report', get_string('report'));
        $reporturl = new moodle_url('/local/usercompletion/report.php', ['id' => $row->id]);
        $titlestr = get_string('pluginname', 'local_usercompletion');

        return html_writer::link($reporturl, $reporticon, ['title' => $titlestr, 'class' => 'user-completion-report']);
    }
}
