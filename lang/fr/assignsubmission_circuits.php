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

$string['allowcircuitssubmissions'] = 'Permis';
$string['default'] = 'Permis par defaut';
$string['default_help'] = 'If set, this submission method will be enabled by default for all new assignments.';
$string['enabled'] = 'Circuits';
$string['enabled_help'] = 'If enabled, students are able to type json directly into a dedicated editor field for their submission.';
$string['nosubmission'] = 'Rien de soumis pour ce devoir.';
$string['c_expansion']= 'Un circuit a été soumis. <br/>Découvrez le circuit en utilisant le bouton ci-contre.';
$string['circuitsjson'] = 'Contenu json du circuit initial';
$string['circuitsjson_help'] = 'Une description valide du circuit initial peut être fournie au format json
<pre>
{
      "width":800,
      "height":600
}
</pre>';
$string['circuitsdevices'] = 'Contenu json des composants additionnels de la boite à outils sous la forme d\'un tableau json de circuits';
$string['circuitsdevices_help'] = 'Une description valide peut être fournie au format json.
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
  <h3>Utilisation</h3>
<ul>
  <li>Prendre un composant dans la boîte à outils et le déplacer à droite.</li>
  <li>Les connecter en glissant entre les connecteur. Les entrées sont en jaune,
  les sorties sont en blanc. On peut connecter une sortie blanche sur
  de multiples entrées jaunes, mais on ne peut connecter qu'une sortie blanche à
  une entrée jaune.</li>
  <li>Cliquer sur un connecteur d'entrée pour le déconnecter.</li>
  <li>Déplacer un composant dans la boîte à outils si vous n'en avez plus
  besoin.</li>
  <li>Double-Cliquer sur une étiquette pour editer le nom d'un composant.</li>
  <li>Double-Cliquer sur une bibliothèque pour ouvrir le circuit à l'intérieur.</li>
  <li>Ctrl+Clic(Mac:command+Clic) pour changer de vue (Circuit en live, ou données JSON).</li>
</ul>
";
$string['details'] = 'Circuits:';
$string['json'] = 'Json';
$string['circuitsfilename'] = 'circuits.html';
$string['circuitssubmission'] = 'Permettre la soumission de circuits';
$string['pluginname'] = 'Circuits submissions';
$string['numwords'] = '({$a} mots)';
$string['numwordsforlog'] = 'Nombre de mots de la soumission : {$a} mots';
