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
 * User list view.
 *
 * @package    local_usercompletion
 * @copyright  2019 Mitxel Moriana <moriana.mitxel@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use local_usercompletion\output\renderer;
use local_usercompletion\output\userlist_view;

require_once(__DIR__ . '/../../config.php');

$userid = optional_param('id', 0, PARAM_INT);

// Check permissions.
require_login();
if (!is_siteadmin()) {
    throw new moodle_exception('accessdenied', 'admin');
}

$PAGE->set_pagelayout('admin');
$PAGE->set_url(new moodle_url('/local/usercompletion/index.php'));
$context = context_system::instance();
$PAGE->set_context($context);
$pluginnamestr = get_string('pluginname', 'local_usercompletion');
$PAGE->set_title("$SITE->shortname: " . $pluginnamestr);
$PAGE->set_heading($SITE->fullname);

/** @var renderer|core_renderer $output */
$output = $PAGE->get_renderer('local_usercompletion');
echo $output->header();
echo $output->heading($pluginnamestr);
echo $output->render_userlist_view(new userlist_view());
echo $output->footer();
