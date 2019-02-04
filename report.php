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
 * Completion report view.
 *
 * @package    local_usercompletion
 * @copyright  2019 Mitxel Moriana <moriana.mitxel@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use local_usercompletion\output\completionreport_view;
use local_usercompletion\output\renderer;

require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');

$userid = required_param('id', PARAM_INT);

// Check permissions.
require_login();
if (!is_siteadmin()) {
    throw new moodle_exception('accessdenied', 'admin');
}

$context = context_system::instance();
$PAGE->set_pagelayout('admin');
$PAGE->set_url(new moodle_url('/local/usercompletion/report.php'), ['id' => $userid]);
$PAGE->set_context($context);
$pluginnamestr = get_string('pluginname', 'local_usercompletion');
$userfullname = format_string(fullname(core_user::get_user($userid, '*', MUST_EXIST)));
$PAGE->set_title($SITE->shortname . ': ' . $pluginnamestr . ': ' . $userfullname);
$PAGE->set_heading($SITE->fullname);
$PAGE->navbar->add(get_string('administrationsite'), new moodle_url('/admin/search.php'));
$PAGE->navbar->add(get_string('reports'), new moodle_url('/admin/category.php', ['category' => 'reports']));
$PAGE->navbar->add($pluginnamestr, new moodle_url('/local/usercompletion/index.php'));
$PAGE->navbar->add($userfullname);
$PAGE->navbar->make_active();

/** @var renderer|core_renderer $output */
$output = $PAGE->get_renderer('local_usercompletion');
echo $output->header();
echo $output->heading($pluginnamestr . ': ' . $userfullname);
echo $output->render_completionreport_view(new completionreport_view($context, $userid));
echo $output->footer();
