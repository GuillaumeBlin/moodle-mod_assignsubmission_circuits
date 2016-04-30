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
 * This file contains the definition for the library class for circuits submission plugin
 *
 * This class provides all the functionality for the new assign module.
 *
 * @package   assignsubmission_circuits
 * @copyright 2016 Guillaume Blin 
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot.'/config.php');
/**
 * library class for circuits submission plugin extending submission plugin base class
 *
 */
class assign_submission_circuits extends assign_submission_plugin {

 
    /**
     * Get the name of the circuits submission plugin
     * @return string
     */
    public function get_name() {
        return get_string('details', 'assignsubmission_circuits');
    }

    /**
     * Get circuits submission information from the database
     *
     * @param  int $submissionid
     * @return mixed
     */
    private function get_circuits_submission($submissionid) {
        global $DB;
        return $DB->get_record('assignsubmission_circuits', array('submission' => $submissionid));
    }

    /**
     * Save the settings for circuits submission plugin
     *
     * @param stdClass $data
     * @return bool
     */
    public function save_settings(stdClass $data) {

        $this->set_config('c_json', $data->assignsubmission_circuits_json);
        $this->set_config('c_devices', $data->assignsubmission_circuits_devices);
	$this->set_config('c_width', $data->assignsubmission_circuits_width);
	$this->set_config('c_height', $data->assignsubmission_circuits_height);
	$dev=json_decode($data->assignsubmission_circuits_devices);
        $t="";
	if (is_object($dev)) {
		foreach($dev as $d){
                	$t.=$t."#".$d->id;
        	}
	}
	$this->set_config('c_toolbox', implode("#",$data->assignsubmission_circuits_toolbox).$t);
	return true;
    }

    public function get_settings(MoodleQuickForm $mform) {
        $json = $this->get_config('c_json');
	$devices = $this->get_config('c_devices');
	$tools=explode("#",get_string('circuitstbcomponents','circuits'));
	$selectedtools=$this->get_config('c_toolbox');
	$too='<script>
        var color, i, j, values="'.$selectedtools.'",    
        options = document.getElementById("id_assignsubmission_circuits_toolbox").options;
        values=values.split("#");
        for ( i = 0; i < values.length; i++ ) {
                for ( j = 0, color = values[i]; j < options.length; j++ ) {
                        options[j].selected = options[j].selected || color === options[j].text;
                }
        }
        </script>';
	$dev=json_decode($devices);
	if (is_object($dev)) {
        	foreach($dev as $d){
                	array_push($tools,$d->id);
        	}
	}
	$select = $mform->addElement('select', 'assignsubmission_circuits_toolbox', get_string('circuitstoolbox','circuits'), array_combine($tools,$tools)); 
	$select->setMultiple(true);
	$mform->addElement('html',$too);
	$mform->addElement('text', 'assignsubmission_circuits_width', get_string('circuitswidth', 'circuits'), array('size'=>'20'));
	$mform->addElement('text', 'assignsubmission_circuits_height', get_string('circuitsheight', 'circuits'), array('size'=>'20'));
	$mform->addElement('textarea', 'assignsubmission_circuits_json', get_string('circuitsjson', 'circuits'),'wrap="virtual" rows="20" cols="50"');
	$mform->addElement('textarea', 'assignsubmission_circuits_devices', get_string('circuitsdevices', 'circuits'),'wrap="virtual" rows="20" cols="50"');
	$mform->setType('assignsubmission_circuits_width', PARAM_TEXT);
	$mform->setType('assignsubmission_circuits_height', PARAM_TEXT);
	//$mform->addRule('assignsubmission_circuits_width', null, 'required',null, 'client');
	$mform->addRule('assignsubmission_circuits_width', null, 'numeric',null, 'client');
        //$mform->addRule('assignsubmission_circuits_height', null, 'required',null, 'client');
	$mform->addRule('assignsubmission_circuits_height', null, 'numeric',null, 'client');
	$mform->setDefault('assignsubmission_circuits_width', $this->get_config('c_width'));
        $mform->setDefault('assignsubmission_circuits_height', $this->get_config('c_height'));
        $mform->setDefault('assignsubmission_circuits_json', $json);
        $mform->addHelpButton('assignsubmission_circuits_json', 'circuitsjson', 'circuits');
	$mform->addHelpButton('assignsubmission_circuits_devices', 'circuitsdevices', 'circuits');
        $mform->setDefault('assignsubmission_circuits_devices', $devices);
	$mform->disabledIf('assignsubmission_circuits_toolbox', 'assignsubmission_circuits_enabled', 'notchecked');
        $mform->disabledIf('assignsubmission_circuits_width', 'assignsubmission_circuits_enabled', 'notchecked');
        $mform->disabledIf('assignsubmission_circuits_height', 'assignsubmission_circuits_enabled', 'notchecked');
	$mform->disabledIf('assignsubmission_circuits_json', 'assignsubmission_circuits_enabled', 'notchecked');
	$mform->disabledIf('assignsubmission_circuits_devices', 'assignsubmission_circuits_enabled', 'notchecked');
   }

    /**
     * Add form elements for settings
     *
     * @param mixed $submission can be null
     * @param MoodleQuickForm $mform
     * @param stdClass $data
     * @return true if elements were added to the form
     */
    public function get_form_elements($submission, MoodleQuickForm $mform, stdClass $data) {
        global $PAGE;
	$elements = array();
        $submissionid = $submission ? $submission->id : 0;

        if (!isset($data->circuits)) {
            $data->circuits = '';
        }

	$c=$this->get_config('c_json');
	//if(strcmp($c,"")==0){
	//	$c=get_string('circuitsdefault','assignsubmission_circuits');
	//}
	$d=$c;
        if ($submission) {
            $circuitssubmission = $this->get_circuits_submission($submission->id);
            if ($circuitssubmission) {
                $data->json = $circuitssubmission->json;
		$d=$circuitssubmission->json;
            }
        }
	$orig=json_decode($c);
	$sub=json_decode($d);
	$orig->devices=$sub->devices;
	if($orig->devices==null){
		$orig->devices=array();
	}
	$orig->connectors=$sub->connectors;
	if($orig->connectors==null){
       		$orig->connectors=array();
	}
	$orig->width=($this->get_config('c_width')?$this->get_config('c_width'):200);
	$orig->height=($this->get_config('c_height')?$this->get_config('c_height'):200);
	$t=explode("#",$this->get_config('c_toolbox'));
	$to="[";	
	foreach($t as $v){
		$to.='{"type":"'.$v.'"},';
	}
	$to=rtrim($to,",");
	$to.=']';
	$orig->toolbox=($this->get_config('c_toolbox')?json_decode($to):array());
	$c=json_encode($orig);
	$mform->addElement('html','<div class="simcir-global"><div class="box generalbox b" style="text-align:left">'.get_string('circuitsinfo', 'circuits').'</div><br/><br/><div class="simcir" id="Archisimcir_'.$submissionid.'">'.$c.'</div></div>');
	$PAGE->requires->js_call_amd('mod_circuits/simcir','init');
	$PAGE->requires->js_call_amd('mod_circuits/simcir','addBasicSet');
	$PAGE->requires->js_call_amd('mod_circuits/simcir','library');
	$PAGE->requires->js_call_amd('mod_circuits/simcir','addDevice',array($this->get_config('c_devices')));
	$PAGE->requires->js_call_amd('mod_circuits/simcir','addVirtualPort');
	$PAGE->requires->js_call_amd('mod_circuits/simcir','start');
	$PAGE->requires->js_call_amd('mod_circuits/simcir','form',array(array("form" => "#".$mform->_attributes["id"], "src" => "#Archisimcir_".$submissionid, "dst" => "input[name=json]")));
	$mform->addElement('hidden', 'json', get_string('json', 'assignsubmission_circuits'));
	$mform->setType('json', PARAM_RAW);
	return true;
    }

    /**
     * Save data to the database
     *
     * @param stdClass $submission
     * @param stdClass $data
     * @return bool
     */
    public function save(stdClass $submission, stdClass $data) {
        global $DB;
        $circuitssubmission = $this->get_circuits_submission($submission->id);
	if ($circuitssubmission) {
            $circuitssubmission->json = $data->json;
            return $DB->update_record('assignsubmission_circuits', $circuitssubmission);
        } else {
            $circuitssubmission = new stdClass();
            $circuitssubmission->json = $data->json;
            $circuitssubmission->submission = $submission->id;
            $circuitssubmission->assignment = $this->assignment->get_instance()->id;
            return $DB->insert_record('assignsubmission_circuits', $circuitssubmission) > 0;
        }
    }

    /**
     * Display circuits word count in the submission status table
     *
     * @param stdClass $submission
     * @param bool $showviewlink - If the summary has been truncated set this to true
     * @return string
     */
    public function view_summary(stdClass $submission, & $showviewlink) {
        $circuitssubmission = $this->get_circuits_submission($submission->id);
        // always show the view link
        $showviewlink = true;

        if ($circuitssubmission) {
            $text = format_text($circuitssubmission->json, FORMAT_PLAIN, array('context' => $this->assignment->get_context()));
            $shorttext = get_string('c_expansion','assignsubmission_circuits')." ";
            if ($text != $shorttext) {
                return $shorttext . get_string('numwords', 'assignsubmission_circuits', count_words($text));
            } else {
                return $shorttext;
            }
        }
        return '';
    }

    /**
     * Display the saved text content from the editor in the view table
     *
     * @param stdClass $submission
     * @return string
     */
    public function view(stdClass $submission) {
        global $PAGE;
	global $doneyet;
	global $CFG;
	$result = '';

        $circuitssubmission = $this->get_circuits_submission($submission->id);
	$jsonheading = html_writer::tag('span', get_string('json', 'assignsubmission_circuits'), array('class' => 'bold'));
	$jsonheading .= html_writer::tag('span',get_string('circuitsinfo', 'assignsubmission_circuits'), array('style' =>'text-align:left'));
        if ($circuitssubmission) {
        	$result = html_writer::tag('div', $jsonheading . '<div class="simcir" id="Archisimcir_'.$submission->id.'">' . $circuitssubmission->json.'</div>', array('class' => 'simcir-global'));	
        	if(!$doneyet){
			$PAGE->requires->js_call_amd('mod_circuits/simcir','init');
	        	$PAGE->requires->js_call_amd('mod_circuits/simcir','addBasicSet');
        		$PAGE->requires->js_call_amd('mod_circuits/simcir','library');
	        	$PAGE->requires->js_call_amd('mod_circuits/simcir','addDevice',array($this->get_config('c_devices')));
 	    	   	$PAGE->requires->js_call_amd('mod_circuits/simcir','addVirtualPort');
       	 		$PAGE->requires->js_call_amd('mod_circuits/simcir','start');
		}
        }
	$doneyet=true;
        return $result;

    }

    /**
     * Return true if this plugin can upgrade an old Moodle 2.2 assignment of this type and version.
     *
     * @param string $type old assignment subtype
     * @param int $version old assignment version
     * @return bool True if upgrade is possible
     */
    public function can_upgrade($type, $version) {
        return false;
    }

    /**
     * Upgrade the settings from the old assignment to the new plugin based one
     *
     * @param context $oldcontext - the database for the old assignment context
     * @param stdClass $oldassignment - the database for the old assignment instance
     * @param string $log record log events here
     * @return bool Was it a success?
     */
    public function upgrade_settings(context $oldcontext, stdClass $oldassignment, & $log) {
        // first upgrade settings (nothing to do)
	return true;
    }


    /**
     * Formatting for log info
     *
     * @param stdClass $submission The new submission
     * @return string
     */
    public function format_for_log(stdClass $submission) {
        return '';
    }

    /**
     * The assignment has been deleted - cleanup
     *
     * @return bool
     */
    public function delete_instance() {
        global $DB;
	$DB->delete_records('assignsubmission_circuits', array('assignment' => $this->assignment->get_instance()->id));
        return true;
    }

    /**
     * No text is set for this plugin
     *
     * @param stdClass $submission
     * @return bool
     */
    public function is_empty(stdClass $submission) {
        return $this->view($submission) == '';
    }

}

