<?php
// This file is part of the circuits submission sub plugin - http://elearningstudio.co.uk
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
 * This file contains the class for restore of this submission plugin
 *
 * @package   assignsubmission_circuits
 * @copyright 2016 Guillaume Blin 
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * restore subplugin class that provides the necessary information needed to restore one assign_submission subplugin.
 *
 * @package assignsubmission_circuits
 * @copyright 2016 Guillaume Blin
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_assignsubmission_circuits_subplugin extends restore_subplugin {

    /**
     *
     * Returns array the paths to be handled by the subplugin at assignment level
     * @return array
     */
    protected function define_submission_subplugin_structure() {

        $paths = array();

        $elename = $this->get_namefor('submission');
        $elepath = $this->get_pathfor('/submission_circuits'); // we used get_recommended_name() so this works
        $paths[] = new restore_path_element($elename, $elepath);

        return $paths; // And we return the interesting paths
    }

    /**
     * Processes one assignsubmission_circuits element
     *
     * @param mixed $data
     */
    public function process_assignsubmission_circuits_submission($data) {
        global $DB;

        $data = (object)$data;
        $data->assignment = $this->get_new_parentid('assign');
        $oldsubmissionid = $data->submission;
        // the mapping is set in the restore for the core assign activity. When a submission node is processed
        $data->submission = $this->get_mappingid('submission', $data->submission);

        $DB->insert_record('assignsubmission_circuits', $data);

        $this->add_related_files('assignsubmission_circuits', 'submissions_circuits', 'submission', null, $oldsubmissionid);
    }

}
