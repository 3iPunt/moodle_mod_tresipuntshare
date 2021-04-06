<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Library of interface functions and constants.
 *
 * @package     mod_tresipuntshare
 * @copyright   2021 Your Name <you@example.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Return if the plugin supports $feature.
 *
 * @param string $feature Constant representing the feature.
 * @return int True if the feature is supported, null otherwise.
 */
function tresipuntshare_supports($feature) {
    switch ($feature) {
        case FEATURE_MOD_INTRO:
            return false;
        case FEATURE_MOD_ARCHETYPE:
            return MOD_ARCHETYPE_RESOURCE;
        default:
            return null;
    }
}

/**
 * Saves a new instance of the mod_tresipuntshare into the database.
 *
 * Given an object containing all the necessary data, (defined by the form
 * in mod_form.php) this function will create a new instance and return the id
 * number of the instance.
 *
 * @param object $moduleinstance An object from the form.
 * @param mod_tresipuntshare_mod_form $mform The form.
 * @return int The id of the newly inserted record.
 */
function tresipuntshare_add_instance($moduleinstance, $mform = null) {
    global $DB;

    $moduleinstance->timecreated = time();

    $id = $DB->insert_record('tresipuntshare', $moduleinstance);

    return $id;
}

/**
 * Updates an instance of the mod_tresipuntshare in the database.
 *
 * Given an object containing all the necessary data (defined in mod_form.php),
 * this function will update an existing instance with new data.
 *
 * @param object $moduleinstance An object from the form in mod_form.php.
 * @param mod_tresipuntshare_mod_form $mform The form.
 * @return bool True if successful, false otherwise.
 */
function tresipuntshare_update_instance($moduleinstance, $mform = null) {
    global $DB;

    $moduleinstance->timemodified = time();
    $moduleinstance->id = $moduleinstance->instance;

    return $DB->update_record('tresipuntshare', $moduleinstance);
}

/**
 * Removes an instance of the mod_tresipuntshare from the database.
 *
 * @param int $id Id of the module instance.
 * @return bool True if successful, false on failure.
 */
function tresipuntshare_delete_instance($id) {
    global $DB;

    $exists = $DB->get_record('tresipuntshare', array('id' => $id));
    if (!$exists) {
        return false;
    }

    $DB->delete_records('tresipuntshare', array('id' => $id));

    return true;
}

/**
 * Running addtional permission check on plugin, for example, plugins
 * may have switch to turn on/off comments option, this callback will
 * affect UI display, not like pluginname_comment_validate only throw
 * exceptions.
 * Capability check has been done in comment->check_permissions(), we
 * don't need to do it again here.
 *
 * @package  mod_tresipuntshare
 * @category comment
 *
 * @param stdClass $comment_param {
 *              context  => context the context object
 *              courseid => int course id
 *              cm       => stdClass course module object
 *              commentarea => string comment area
 *              itemid      => int itemid
 * }
 * @return array
 */
function tresipuntshare_comment_permissions($comment_param) {
    return array('post'=>true, 'view'=>true);
}

/**
 * Validate comment parameter before perform other comments actions
 *
 * @package  mod_glossary
 * @category comment
 *
 * @param stdClass $comment_param {
 *              context  => context the context object
 *              courseid => int course id
 *              cm       => stdClass course module object
 *              commentarea => string comment area
 *              itemid      => int itemid
 * }
 * @return boolean
 */
function tresipuntshare_comment_validate($comment_param) {
    return true;
}
