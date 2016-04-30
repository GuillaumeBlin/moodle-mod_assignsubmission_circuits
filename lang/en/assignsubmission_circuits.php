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
 * Strings for component 'assignsubmission_circuits', language 'en'
 *
 * @package   assignsubmission_circuits
 * @copyright 2016 Guillaume Blin 
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['allowcircuitssubmissions'] = 'Enabled';
$string['default'] = 'Enabled by default';
$string['default_help'] = 'If set, this submission method will be enabled by default for all new assignments.';
$string['enabled'] = 'Circuits';
$string['enabled_help'] = 'If enabled, students are able to type json directly into a dedicated editor field for their submission.';
$string['nosubmission'] = 'Nothing has been submitted for this assignment';
$string['c_expansion']= 'A circuit was submitted. <br/>Expand the circuits using the above button to visualize the circuit.';
$string['circuitsjson'] = 'json content of the initial circuit';
$string['circuitsjson_help'] = 'A valid description of the initial circuit should be p
rovided in json format. 
<pre>
{
      "width":800,
      "height":600
}
</pre>';
$string['circuitsdevices'] = 'json content of addon devices for toolbox as a json arra
y of json circuits';
$string['circuitsdevices_help'] = 'A valid description of circuits should be provided 
in json format. 
<pre>
[
  {
    "id":"Foo",
    "json":
   {
      "width":500,
      "height":500,
      "showToolbox":false,
      "toolbox":[],
      "devices":[
 	...
      ],
      "connectors":[
        ...
      ]
   }
 },
 {
    "id":"Bar",
    "json":
   {
      "width":500,
      "height":500,
      "showToolbox":false,
      "toolbox":[],
      "devices":[
        ...
      ],
      "connectors":[
        ...
      ]
   }
 }
]</pre>';
$string['circuits'] = 'Circuits';
$string['circuitsinfo'] = "
  <h3>Usage</h3>
<ul>
<li>Choose a device from the toolbox and move to right side.</li>
<li>Connect them by drag operation.</li>
<li>Click an input node to disconnect.</li>
<li>Move a device back to the toolbox if you don't use.</li>
<li>Ctrl+Click(Mac:command+Click) to toggle view (Live circuit or JSON data).</li>
<li>Double-Click a label to edit device name.</li>
</ul>
";
$string['details'] = 'Circuits:';
$string['json'] = 'Json';
$string['circuitsfilename'] = 'circuits.html';
$string['circuitssubmission'] = 'Allow Circuits submission';
$string['pluginname'] = 'Circuits submissions';
$string['numwords'] = '({$a} words)';
$string['numwordsforlog'] = 'Submission word count: {$a} words';
